<?php
/**
 * Created by PhpStorm.
 * User: jacob
 * Date: 7/1/2018
 * Time: 8:00 AM
 */

namespace Google\Types;

use Exception;
use Psr\Http\Message\StreamInterface;


class PlaceAutoComplete
{

    //indicates that no errors occurred and at least one result was returned.
    const STATUS__OK = "OK";

    //indicates that the search was successful but returned no results. This may occur if the search was passed a bounds in a remote location.
    const STATUS__ZERO_RESULTS = "ZERO_RESULTS";

    //indicates that you are over your quota.
    const STATUS__OVER_QUERY_LIMIT = "OVER_QUERY_LIMIT";

    //indicates that your request was denied, generally because of lack of an invalid key parameter.
    const STATUS__REQUEST_DENIED = "REQUEST_DENIED";

    //generally indicates that the input parameter is missing.
    const STATUS__INVALID_REQUEST = "INVALID_REQUEST";

    //indicates a server-side error; trying again may be successful.
    const STATUS__UNKNOWN_ERROR = "UNKNOWN_ERROR";

    const FIELD__STATUS = "status";
    const FIELD__PREDICTIONS = "predictions";
    const FIELD__ERROR_MESSAGE = "error_message";

    protected $status;
    protected $predictions;

    /**
     * @var string
     * When the Places service returns a status code other than OK,
     * there may be an additional error_message field within the response object.
     * This field contains more detailed information about the reasons behind the given status code.
     * Note: This field is not guaranteed to be always present, and its content is subject to change.
     */
    protected $errorMessage;

    public function __construct(StreamInterface $googleResponse)
    {
        $isAssoc = true;
        $data = json_decode($googleResponse, $isAssoc);
        if (!array_key_exists(self::FIELD__PREDICTIONS, $data)) {
            throw new Exception("Google Places Response is missing key: " . self::KEY__RESULTS);
        }

        if (!array_key_exists(self::FIELD__STATUS, $data)) {
            throw new Exception("Google Places Response is missing key: " . self::KEY__STATUS);
        }

        $this->init($data);
    }

    protected function init(array $data)
    {
        $predictions = $data[self::FIELD__PREDICTIONS];
        $status = $data[self::FIELD__STATUS];

        if (!in_array($status, [self::STATUS__OK, self::STATUS__ZERO_RESULTS])) {
            throw new Exception("Google Places API returned wrong status {$status}");
        }

        $this->predictions = $predictions;
    }

    public function getResults()
    {
        return $this->predictions;
    }
}