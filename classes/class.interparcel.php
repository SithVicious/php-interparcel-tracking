<?php

  class Tracking_Interparcel
	{

		var $apiKey;

		function __construct($apiKey)
		{
			$this->apiKey = $apiKey;
		}

		public function getTracking($tracking_code)
		{

			if ($tracking_code == '') {
				return array("success" => false,
					"response" => array("error" => "Tracking code is empty.")
				);
			}

			if (strlen($tracking_code) != 12) {
				return array("success" => false,
					"response" => array("error" => "Tracking code is not 12 digits.")
				);
			}

			if (!is_numeric(substr($tracking_code, 2, 10))) {
				return array("success" => false,
					"response" => array("error" => "Tracking code is not a number.")
				);
			}


			switch (substr($tracking_code, 0, 2)) {
				case "AU":
					$apiURL = 'https://api.au.interparcel.com/tracking/v1/' . $tracking_code;
					break;

				case "GB":
					$apiURL = 'https://api.uk.interparcel.com/tracking/v1/' . $tracking_code;
					break;

				case "NZ":
					$apiURL = 'https://api.nz.interparcel.com/tracking/v1/' . $tracking_code;
					break;

				default:
					return array("success" => false,
						"response" => array("error" => "Tracking code should start with AU, GB or NZ")
					);
			}


			$curl = curl_init();
			curl_setopt_array($curl, array(
				CURLOPT_URL => $apiURL,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => '',
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 0,
				CURLOPT_FOLLOWLOCATION => true,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => 'GET',
				CURLOPT_HTTPHEADER => array(
					'X-Interparcel-Auth: ' . $this->apiKey, #TODO: Move X-Interparcel-Auth to config.php
					'Content-Type: application/json'
				),
			));

			$response = curl_exec($curl);
			curl_close($curl);

			if (!$response) {
				return array("success" => false);
			} else {
				return json_decode($response, true);
			}
		}
	}
