<?php

namespace Google\Types;

use Exception;
use Illuminate\Contracts\Support\Arrayable;

class GooglePlacesResult implements Arrayable {

	const KEY_TYPE_AIRPORT = "airport",
		  KEY_TYPE_AMUSEMENT_PARK = "amusement_park",
		  KEY_TYPE_AQUARIUM = "aquarium",
		  KEY_TYPE_ART_GALLERY = "art_gallery",
		  KEY_TYPE_ATM = "atm",
		  KEY_TYPE_BAKERY = "bakery",
		  KEY_TYPE_BANK = "bank",
		  KEY_TYPE_BAR = "bar",
		  KEY_TYPE_BEAUTY_SALON = "beauty_salon",
		  KEY_TYPE_BICYCLE_STORE = "bicycle_store",
		  KEY_TYPE_BOOK_STORE = "book_store",
		  KEY_TYPE_BOWLING_ALLEY = "bowling_alley",
		  KEY_TYPE_BUS_STATION = "bus_station",
		  KEY_TYPE_CAFE = "cafe",
		  KEY_TYPE_CAMPGROUND = "campground",
		  KEY_TYPE_CAR_DEALER = "car_dealer",
		  KEY_TYPE_CAR_RENTAL = "car_rental",
		  KEY_TYPE_CAR_REPAIR = "car_repair",
		  KEY_TYPE_CAR_WASH = "car_wash",
		  KEY_TYPE_CASINO = "casino",
		  KEY_TYPE_CEMETERY = "cemetery",
		  KEY_TYPE_CHURCH = "church",
		  KEY_TYPE_CITY_HALL = "city_hall",
		  KEY_TYPE_CLOTHING_STORE = "clothing_store",
		  KEY_TYPE_CONVENIENCE_STORE = "convenience_store",
		  KEY_TYPE_COURTHOUSE = "courthouse",
		  KEY_TYPE_DENTIST = "dentist",
		  KEY_TYPE_DEPARTMENT_STORE = "department_store",
		  KEY_TYPE_DOCTOR = "doctor",
		  KEY_TYPE_ELECTRICIAN = "electrician",
		  KEY_TYPE_ELECTRONICS_STORE = "electronics_store",
		  KEY_TYPE_EMBASSY = "embassy",
		  KEY_TYPE_FIRE_STATION = "fire_station",
		  KEY_TYPE_FLORIST = "florist",
		  KEY_TYPE_FUNERAL_HOME = "funeral_home",
		  KEY_TYPE_FURNITURE_STORE = "furniture_store",
		  KEY_TYPE_GAS_STATION = "gas_station",
		  KEY_TYPE_GYM = "gym",
		  KEY_TYPE_HAIR_CARE = "hair_care",
		  KEY_TYPE_HARDWARE_STORE = "hardware_store",
		  KEY_TYPE_HINDU_TEMPLE = "hindu_temple",
		  KEY_TYPE_HOME_GOODS_STORE = "home_goods_store",
		  KEY_TYPE_HOSPITAL = "hospital",
		  KEY_TYPE_INSURANCE_AGENCY = "insurance_agency",
		  KEY_TYPE_JEWELRY_STORE = "jewelry_store",
		  KEY_TYPE_LAUNDRY = "laundry",
		  KEY_TYPE_LAWYER = "lawyer",
		  KEY_TYPE_LIBRARY = "library",
		  KEY_TYPE_LIQUOR_STORE = "liquor_store",
		  KEY_TYPE_LOCAL_GOVERNMENT_OFFICE = "local_government_office",
		  KEY_TYPE_LOCKSMITH = "locksmith",
		  KEY_TYPE_LODGING = "lodging",
		  KEY_TYPE_MEAL_DELIVERY = "meal_delivery",
		  KEY_TYPE_MEAL_TAKEAWAY = "meal_takeaway",
		  KEY_TYPE_MOSQUE = "mosque",
		  KEY_TYPE_MOVIE_RENTAL = "movie_rental",
		  KEY_TYPE_MOVIE_THEATER = "movie_theater",
		  KEY_TYPE_MOVING_COMPANY = "moving_company",
		  KEY_TYPE_MUSEUM = "museum",
		  KEY_TYPE_NIGHT_CLUB = "night_club",
		  KEY_TYPE_PAINTER = "painter",
		  KEY_TYPE_PARK = "park",
		  KEY_TYPE_PARKING = "parking",
		  KEY_TYPE_PET_STORE = "pet_store",
		  KEY_TYPE_PHARMACY = "pharmacy",
		  KEY_TYPE_PHYSIOTHERAPIST = "physiotherapist",
		  KEY_TYPE_PLACE_OF_WORSHIP = "place_of_worship",
		  KEY_TYPE_PLUMBER = "plumber",
		  KEY_TYPE_POLICE = "police",
		  KEY_TYPE_POST_OFFICE = "post_office",
		  KEY_TYPE_REAL_ESTATE_AGENCY = "real_estate_agency",
		  KEY_TYPE_RESTAURANT = "restaurant",
		  KEY_TYPE_ROOFING_CONTRACTOR = "roofing_contractor",
		  KEY_TYPE_RV_PARK = "rv_park",
		  KEY_TYPE_SCHOOL = "school",
		  KEY_TYPE_SHOE_STORE = "shoe_store",
		  KEY_TYPE_SHOPPING_MALL = "shopping_mall",
		  KEY_TYPE_SPA = "spa",
		  KEY_TYPE_STADIUM = "stadium",
		  KEY_TYPE_STORAGE = "storage",
		  KEY_TYPE_STORE = "store",
		  KEY_TYPE_SUBWAY_STATION = "subway_station",
		  KEY_TYPE_SYNAGOGUE = "synagogue",
		  KEY_TYPE_TAXI_STAND = "taxi_stand",
		  KEY_TYPE_TRAIN_STATION = "train_station",
		  KEY_TYPE_TRANSIT_STATION = "transit_station",
		  KEY_TYPE_TRAVEL_AGENCY = "travel_agency",
		  KEY_TYPE_UNIVERSITY = "university",
		  KEY_TYPE_VETERINARY_CARE = "veterinary_care",
		  KEY_TYPE_ZOO = "zoo";

	const TYPES = [
		self::KEY_TYPE_AIRPORT,
		self::KEY_TYPE_AMUSEMENT_PARK,
		self::KEY_TYPE_AQUARIUM,
		self::KEY_TYPE_ART_GALLERY,
		self::KEY_TYPE_ATM,
		self::KEY_TYPE_BAKERY,
		self::KEY_TYPE_BANK,
		self::KEY_TYPE_BAR,
		self::KEY_TYPE_BEAUTY_SALON,
		self::KEY_TYPE_BICYCLE_STORE,
		self::KEY_TYPE_BOOK_STORE,
		self::KEY_TYPE_BOWLING_ALLEY,
		self::KEY_TYPE_BUS_STATION,
		self::KEY_TYPE_CAFE,
		self::KEY_TYPE_CAMPGROUND,
		self::KEY_TYPE_CAR_DEALER,
		self::KEY_TYPE_CAR_RENTAL,
		self::KEY_TYPE_CAR_REPAIR,
		self::KEY_TYPE_CAR_WASH,
		self::KEY_TYPE_CASINO,
		self::KEY_TYPE_CEMETERY,
		self::KEY_TYPE_CHURCH,
		self::KEY_TYPE_CITY_HALL,
		self::KEY_TYPE_CLOTHING_STORE,
		self::KEY_TYPE_CONVENIENCE_STORE,
		self::KEY_TYPE_COURTHOUSE,
		self::KEY_TYPE_DENTIST,
		self::KEY_TYPE_DEPARTMENT_STORE,
		self::KEY_TYPE_DOCTOR,
		self::KEY_TYPE_ELECTRICIAN,
		self::KEY_TYPE_ELECTRONICS_STORE,
		self::KEY_TYPE_EMBASSY,
		self::KEY_TYPE_FIRE_STATION,
		self::KEY_TYPE_FLORIST,
		self::KEY_TYPE_FUNERAL_HOME,
		self::KEY_TYPE_FURNITURE_STORE,
		self::KEY_TYPE_GAS_STATION,
		self::KEY_TYPE_GYM,
		self::KEY_TYPE_HAIR_CARE,
		self::KEY_TYPE_HARDWARE_STORE,
		self::KEY_TYPE_HINDU_TEMPLE,
		self::KEY_TYPE_HOME_GOODS_STORE,
		self::KEY_TYPE_HOSPITAL,
		self::KEY_TYPE_INSURANCE_AGENCY,
		self::KEY_TYPE_JEWELRY_STORE,
		self::KEY_TYPE_LAUNDRY,
		self::KEY_TYPE_LAWYER,
		self::KEY_TYPE_LIBRARY,
		self::KEY_TYPE_LIQUOR_STORE,
		self::KEY_TYPE_LOCAL_GOVERNMENT_OFFICE,
		self::KEY_TYPE_LOCKSMITH,
		self::KEY_TYPE_LODGING,
		self::KEY_TYPE_MEAL_DELIVERY,
		self::KEY_TYPE_MEAL_TAKEAWAY,
		self::KEY_TYPE_MOSQUE,
		self::KEY_TYPE_MOVIE_RENTAL,
		self::KEY_TYPE_MOVIE_THEATER,
		self::KEY_TYPE_MOVING_COMPANY,
		self::KEY_TYPE_MUSEUM,
		self::KEY_TYPE_NIGHT_CLUB,
		self::KEY_TYPE_PAINTER,
		self::KEY_TYPE_PARK,
		self::KEY_TYPE_PARKING,
		self::KEY_TYPE_PET_STORE,
		self::KEY_TYPE_PHARMACY,
		self::KEY_TYPE_PHYSIOTHERAPIST,
		self::KEY_TYPE_PLACE_OF_WORSHIP,
		self::KEY_TYPE_PLUMBER,
		self::KEY_TYPE_POLICE,
		self::KEY_TYPE_POST_OFFICE,
		self::KEY_TYPE_REAL_ESTATE_AGENCY,
		self::KEY_TYPE_RESTAURANT,
		self::KEY_TYPE_ROOFING_CONTRACTOR,
		self::KEY_TYPE_RV_PARK,
		self::KEY_TYPE_SCHOOL,
		self::KEY_TYPE_SHOE_STORE,
		self::KEY_TYPE_SHOPPING_MALL,
		self::KEY_TYPE_SPA,
		self::KEY_TYPE_STADIUM,
		self::KEY_TYPE_STORAGE,
		self::KEY_TYPE_STORE,
		self::KEY_TYPE_SUBWAY_STATION,
		self::KEY_TYPE_SYNAGOGUE,
		self::KEY_TYPE_TAXI_STAND,
		self::KEY_TYPE_TRAIN_STATION,
		self::KEY_TYPE_TRANSIT_STATION,
		self::KEY_TYPE_TRAVEL_AGENCY,
		self::KEY_TYPE_UNIVERSITY,
		self::KEY_TYPE_VETERINARY_CARE,
		self::KEY_TYPE_ZOO,
	];

	//Result Object Keys:
	const KEY__ID = "id";
	const KEY__NAME = "name";
	const KEY__ICON = "icon";
	const KEY__TYPES = "types";
	const KEY__PLACE_ID = "place_id";
	const KEY__GEOMETRY = "geometry";
	const KEY__REFERENCE = "reference";
	const KEY__FORMATTED_ADDRESS = "formatted_address";

	const GOOGLE_SEARCH_RESULT_KEYS = [
		self::KEY__ID,
		self::KEY__NAME,
		self::KEY__ICON,
		self::KEY__TYPES,
		self::KEY__PLACE_ID,
		self::KEY__GEOMETRY,
		self::KEY__REFERENCE,
		self::KEY__FORMATTED_ADDRESS,
	];

	const MANDATORY_FIELDS = [
		self::KEY__NAME,
		self::KEY__GEOMETRY,
		self::KEY__PLACE_ID,
		self::KEY__FORMATTED_ADDRESS,
	];

	private $id;
	private $name;
	private $icon;
	private $types;
	private $place_id;
	private $geometry;
	private $reference;
	private $formatted_address;

	public function __construct( array $result, $mandatoryFields = self::MANDATORY_FIELDS ) {
		foreach ( $mandatoryFields as $key ) {
			if ( ! array_key_exists( $key, $result ) ) {
				throw new Exception( "Google Results must include key: {$key}" );
			}
		}

		$this->init( $result );
	}

	public function init( array $result ) {
		foreach ( $result as $key => $value ) {
			if ( in_array( $key, self::GOOGLE_SEARCH_RESULT_KEYS ) ) {
				call_user_func_array( array( $this, "set" . ucfirst( $key ) ), [ $value ] );
			}
		}
	}

	/**
	 * @return mixed
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @param mixed $id
	 */
	public function setId( $id ) {
		$this->id = $id;
	}

	/**
	 * @return mixed
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @param mixed $name
	 */
	public function setName( $name ) {
		$this->name = $name;
	}

	/**
	 * @return mixed
	 */
	public function getIcon() {
		return $this->icon;
	}

	/**
	 * @param mixed $icon
	 */
	public function setIcon( $icon ) {
		$this->icon = $icon;
	}

	/**
	 * @return mixed
	 */
	public function getTypes() {
		return $this->types;
	}

	/**
	 * @param mixed $types
	 */
	public function setTypes( $types ) {
		$this->types = $types;
	}

	/**
	 * @return mixed
	 */
	public function getPlaceId() {
		return $this->place_id;
	}

	/**
	 * @param mixed $place_id
	 */
	public function setPlace_id( $place_id ) {
		$this->place_id = $place_id;
	}

	/**
	 * @return mixed
	 */
	public function getGeometry() {
		return $this->geometry;
	}

	/**
	 * @param mixed $geometry
	 */
	public function setGeometry( $geometry ) {
		$this->geometry = $geometry;
	}

	/**
	 * @return mixed
	 */
	public function getReference() {
		return $this->reference;
	}

	/**
	 * @param mixed $reference
	 */
	public function setReference( $reference ) {
		$this->reference = $reference;
	}

	/**
	 * @return mixed
	 */
	public function getFormattedAddress() {
		return $this->formatted_address;
	}

	/**
	 * @param mixed $formatted_address
	 */
	public function setFormatted_address( $formatted_address ) {
		$this->formatted_address = $formatted_address;
	}

	public function toArray() {
		$result = [];

		foreach (self::GOOGLE_SEARCH_RESULT_KEYS as $key) {
			$result[$key] = $this->$key;
		}

		return $result;
	}
}