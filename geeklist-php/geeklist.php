<?php
namespace Br\Eng\Arglbr\Geeklist;

const OUTPUT_ARRAY = 1;
const OUTPUT_JSON  = 2;
const GKLST_URL    = 'http://geekli.st/';

abstract class GeeklistPage
{
	protected $username;
	protected $output_format;

	protected function doGetRequest($p_url)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $p_url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_USERAGENT, "fetcher " . time());
		$ret = curl_exec($ch);
		curl_close($ch);
		unset($ch);
		return $ret;
	}

	protected function setUser($p_username)
	{
		$this->username = (strlen(trim($p_username))) ? trim($p_username) : null;
	}

	protected function getUser()
	{
		if (is_null($this->username))
		{
			throw new \Exception('Unknown username. Did you call ' . __CLASS__ . '::SetUser() before?');
		}

		return $this->username;
	}

	protected function setFormat($p_format = null)
	{
		$this->output_format = (isset($p_format)) ? (int) $p_format : namespace\OUTPUT_JSON;
	}

	protected function outputItems($p_items = null)
	{
		switch ($this->output_format)
		{
			case namespace\OUTPUT_ARRAY:
				$ret = (is_array($p_items)) ? $p_items : array($p_items);
				break;
			case namespace\OUTPUT_JSON:
				$ret = json_encode($p_items);
				break;
			default:
				throw new \Exception('Unknown output format. Did you call ' . __CLASS__ . '::SetFormat() before?');
		}

		unset($tmp);
		return $ret;
	}

	abstract protected function treatPage($p_page);
}

class Card extends GeeklistPage
{
	private $cards;

	protected function treatPage($p_page)
	{
		$ret  = array();
		$page = stristr($p_page, '<div class="card-index-box-large">');
		$to   = stripos($page, '<div class="row-box-right-wrapper">');
		$page = strip_tags(substr($page, 0, $to), '<h4>');

		$tagi = '<h4>';
		$tage = '</h4>';

		do {
			$p1    = stripos($page, $tagi);
			$p2    = stripos($page, $tage, $p1);
			$p3    = $p2 - $p1;
			$ret[] = strip_tags(substr($page, $p1, $p3));
			$page  = substr($page, $p2, strlen($page));
		} while ($p1 > 0 || $p2 > 0);

		unset($url, $page, $to, $tagi, $tage, $p1, $p2, $p3);
		return $ret;
	}

	private function getCards()
	{
		if (isset($this->cards) === false)
		{
			$ret     = array();
			$profile = namespace\GKLST_URL . $this->getUser() . '/';

			if ( $page = $this->doGetRequest($profile) );
			{
				$ret = $this->treatPage($page);
			}

			$this->cards = array_filter($ret);
		}
	}

	public function __construct($p_username = null, $p_format = null)
	{
		$this->setUser($p_username);
		$this->setFormat($p_format);
	}

	private function outputCards($p_card = null)
	{
		if ($p_card === false)
		{
			$tmp = array();
		}
		elseif (is_integer($p_card))
		{
			$tmp = $this->cards[$p_card];
		}
		else
		{
			$tmp = $this->cards;
		}

		$ret = $this->outputItems($tmp);
		unset($tmp);
		return $ret;
	}

	public function getRandomCard()
	{
		$this->getCards();
		$card = (count($this->cards) > 0) ? rand(0, (count($this->cards) - 1)) : false;
		return $this->outputCards($card);
	}

	public function getAllCards()
	{
		$this->getCards();
		return $this->outputCards();
	}
}

