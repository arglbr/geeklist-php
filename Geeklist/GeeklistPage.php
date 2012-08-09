<?php
/**
 * Geeklist namespace
 *
 * The initial file for the Geeklist namespace.
 * 
 * This software consists of voluntary contributions made by many
 * individuals and is licensed under the L-GPL license. For more
 * information, see {@link http://www.gnu.org/licenses/lgpl.html LGPL}
 * 
 * @package Geeklist
 */
namespace Geeklist;

/**
 * Constant defining output will be done as array.
 */
const OUTPUT_ARRAY = 1;

/**
 * Constant defining output will be done as JSON string.
 */
const OUTPUT_JSON  = 2;

/**
 * Constant holding the main Geeklist URL.
 */
const GKLST_URL    = 'http://geekli.st/';

/**
 * Common methods for the Geeklist items.
 * @abstract
 */
abstract class GeeklistPage
{
    /**
     * @var string The Geeklist username
     */
    protected $username;

    /**
     * @param \Geeklist\OUTPUT_JSON|\Geeklist\OUTPUT_ARRAY
     */
    protected $output_format;

    /**
     * Realizes the HTTP GET request to fetch data.
     *
     * @param string $p_url
     */
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

    /**
     * Setter for the username
     *
     * @param string $p_username
     */
    public function setUser($p_username)
    {
        $this->username = (strlen(trim($p_username))) ? trim($p_username) : null;
    }

    /**
     * Get the username
     *
     * @return string The username set by constructor or SetUser method.
     */
    public function getUser()
    {
        if (is_null($this->username)) {
            throw new \DomainException('Unknown username. Call ' . __CLASS__ . '::SetUser() with a valid username.', 1000);
        } else {
            return $this->username;
        }
    }

    /**
     * Setter for the output format
     *
     * @param \Geeklist\OUTPUT_JSON|\Geeklist\OUTPUT_ARRAY $p_format
     */
    public function setFormat($p_format = null)
    {
        $this->output_format = (isset($p_format) && (int) $p_format <= 2) ? (int) $p_format : namespace\OUTPUT_ARRAY;
    }

    /**
     * Get the output format
     *
     * @return integer The value of the \Geeklist\OUTPUT_*
     */
    public function getFormat()
    {
        return $this->output_format;
    }

    /**
     * Output the Geeklist items passed as parameter.
     *
     * @param  array        $p_items
     * @return array|string The viewable output of the results.
     */
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

   /**
    * This method treats the page to return the items as needed.
    * For this reason, each class needs to implement this method
    * to return an array with the correct items. As an example:
    * - Class \Geeklist\Card::treatPage will return Cards;
    * - Class \Geeklist\Micro::treatPage will return Micros;
    * - And so on...
    * 
    * @return array An array of extracted items from Geeklist page.
    * @abstract
    */
    abstract protected function treatPage($p_page);
}
