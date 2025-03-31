<?php




if (!function_exists('tronResponse')) {
    /**
     * Generate a JSON response.
     *
     * @param mixed $data
     * @param int $statusCode
     * @param string|null $message
     * @param array $headers
     * @param bool $status
     * @return \Illuminate\Http\JsonResponse
     */
    function tronResponse($data = null, int $statusCode = 200, $message = null, bool $status = true, array $headers = []): \Illuminate\Http\JsonResponse
    {
        $response = [
            'status'  => $status,
            'message' => $message,
            'data'    => $data,
        ];

        return response()->json($response, $statusCode, $headers);
    }

      
}