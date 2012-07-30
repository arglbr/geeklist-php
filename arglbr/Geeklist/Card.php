<?php
namespace arglbr\Geeklist;

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

