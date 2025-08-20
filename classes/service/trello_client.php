<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * functions to connect with Trello.
 *
 * @package    local_trellosync
 * @copyright  2025 Nubia Culma (nubia.culma@openlms.net)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace local_trellosync\service;
defined('MOODLE_INTERNAL') || die();
require_once($CFG->libdir . '/filelib.php');
use curl;
/**
 * Client class to interact with the Trello API.
 *
 * This class provides methods to connect with Trello and perform actions
 * such as creating, updating, deleting and retrieving cards and lists.
 * It manages the authentication using the Trello $apikey and $token.
 *
 * @package    local_trellosync
 */
class trello_client {
    /** @var string Trello API Key */
    private $apikey;
    /** @var string Trello authentication token */
    private $token;

    /**
     * Trello client constructor.
     *
     * @return void
     */
    public function __construct() {
        $settings = get_config('local_trellosync');

        $this->apikey = $settings->apikey;
        $this->token = $settings->token;

    }
    /**
     * Get the lists from the Trello board.
     *
     * @param string $boardid Trello board ID.
     * @return stdClass[]|null Array of list objects, or null if decoding fails.
     */
    public function get_lists($boardid) {
        $url = "https://api.trello.com/1/boards/{$boardid}/lists?key={$this->apikey}&token={$this->token}";

        $curl = new curl();
        $response = $curl->get($url);

        return json_decode($response);
    }
    /**
     * Get the cards from a Trello list.
     *
     * @param string $idlist Trello list ID
     * @return stdClass[] List of cards as objects
     */
    public function get_cards($idlist) {
        $url = "https://api.trello.com/1/lists/{$idlist}/cards?key={$this->apikey}&token={$this->token}";

        $curl = new curl();
        $response = $curl->get($url);
        return json_decode($response);
    }

     /**
      * Create a card in a Trello list with its title, description, and list.
      *
      * @param string $idlist ID of the list.
      * @param string $name Name of the card.
      * @param string $desc Description of the card.
      * @return object Data of the created card
      */
    public function create_card($idlist, $name, $desc) {
        $url = "https://api.trello.com/1/cards";
        $curl = new curl();

        $fields = [
            'idList' => $idlist,
            'name' => $name,
            'desc' => $desc,
            'key' => $this->apikey,
            'token' => $this->token,
        ];

        $curl->post($url, $fields);
        $response = $curl->getResponse();
        return json_decode($response);
    }
    /**
     * Get the data from a specific card.
     *
     * @param string $cardid Card ID.
     * @return object Card data.
     */
    public function get_card($cardid) {
        $url = "https://api.trello.com/1/cards/{$cardid}?key={$this->apikey}&token={$this->token}";

        $curl = new \curl();
        $response = $curl->get($url);
        return json_decode($response);

        if (!$response) {
            throw new \moodle_exception('Could not connect to Trello.');
        }

        return json_decode($response);
    }
    /**
     * update the data of a trello card.
     *
     * @param string $cardid   Card ID.
     * @param string $newname  New name of the card.
     * @param string $newdesc  New description of the card.
     * @param string $newidlist New list.
     * @return object Update card data.
     */
    public function update_card($cardid, $newname, $newdesc, $newidlist) {
        $url = "https://api.trello.com/1/cards/{$cardid}?key={$this->apikey}&token={$this->token}&desc={$newdesc}
        &name={$newname}&idList={$newidlist}";
        $curl = new curl();

        $response = $curl->put($url);

        return json_decode($response);
    }
    /**
     * Delete a Trello card.
     *
     * @param string $cardid Card ID.
     * @return object API rsponse yes or no.
     */
    public function delete_card($cardid) {
        $url = "https://api.trello.com/1/cards/{$cardid}?key={$this->apikey}&token={$this->token}";
        $curl = new curl();

        $response = $curl->delete($url);
        return json_decode($response);
    }

     /**
      * move a card to another list.
      *
      * @param string $cardid    Card ID.
      * @param string $newidlist ID of the new list.
      * @return object API response.
      */
    public function move_card($cardid, $newidlist) {
        $url = "https://api.trello.com/1/cards/{$cardid}?idList={$newidlist}&key={$this->apikey}&token={$this->token}";

        $curl = new curl();

        $response = $curl->put($url);
        return json_decode($response);
    }
}
