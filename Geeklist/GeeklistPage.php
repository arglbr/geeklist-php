<?php
namespace Geeklist;

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

    public function setUser($p_username)
    {
        $this->username = (strlen(trim($p_username))) ? trim($p_username) : null;
    }

    public function getUser()
    {
        if (is_null($this->username)) {
            throw new \DomainException('Unknown username. Call ' . __CLASS__ . '::SetUser() with a valid username.', 1000);
        } else {
            return $this->username;
        }
    }

    public function setFormat($p_format = null)
    {
        $this->output_format = (isset($p_format)) ? (int) $p_format : namespace\OUTPUT_ARRAY;
    }

    public function getFormat()
    {
        return $this->output_format;
    }

    protected function outputItems($p_items = null)
    {
        switch ($this->output_format) {
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
