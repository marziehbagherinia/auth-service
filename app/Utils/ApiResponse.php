<?php

/**
 * Created by PhpStorm.
 * User: faridcs <farid.vosoughi@alopeyk.com>
 * Date: 2019-01-15
 * Time: 12:03
 */

namespace App\Utils;

use Illuminate\Http\JsonResponse;

/**
 * Class ApiResponse
 *
 */
class ApiResponse extends JsonResponse
{
	/**
	 * ApiResponse constructor.
	 *
	 * @param array   $data       Response data.
	 * @param integer $apiStatus  Status of Api.
	 * @param integer $httpStatus Response header status.
	 * @param array   $headers    List of headers.
	 * @param integer $options    Extra options.
	 */
	public function __construct(array $data = [], int $apiStatus = 200, int $httpStatus = 200, array $headers = [], int $options = 0)
	{
		if (isset($data['status']) && $data['status'] == 'fail')
		{
			if ($apiStatus == 200) {
				$apiStatus = 400;
			}

			if ($httpStatus == 200) {
				$httpStatus = 400;
			}
		}

		$response = [
			'status' => isset($data['status']) ? $data['status'] : 'fail',
			'code' => $apiStatus,
			'message' => isset($data['message']) ? $data['message'] : '',
			'object' => isset($data['object']) ? $data['object'] : null,
		];

		parent::__construct($response, $httpStatus, $headers, $options);
	}
}

