<?php


namespace App\Helpers;

use Symfony\Component\HttpFoundation\Response;


class ResponseHelper {
    public const DEFAULT_SUCCESS_MESSAGE        = "Successfully fetched data";
    public const DEFAULT_INTERNAL_ERROR_FMT     = "Some internal server error occurred. %s";
    public const DEFAULT_FORBIDDEN_FMT          = "Cannot access the given route. %s";
    public const BAD_REQUEST_MESSAGE            = "Bad request";
    public const SUCCESSFULLY_CREATED_MESSAGE   = "Successfully Created";
    public const SUCCESSFULLY_DELETED_MESSAGE   = "Successfully Deleted";
    public const SUCCESSFULLY_UPDATED_MESSAGE   = "Successfully Updated";
    public const UNPROCESSABLE_ENTITY_MESSAGE   = "Couldnt process data";


    public static function notFound(string $message) {
        return response()->json([
            "message" => $message
        ], Response::HTTP_NOT_FOUND);
    }

    public static function internalError($details = null) {
        return response()->json([
            "message" => sprintf(self::DEFAULT_INTERNAL_ERROR_FMT, $details)
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }


    public static function forbidden($details = null) {
        return response()->json([
            "message" => sprintf(self::DEFAULT_FORBIDDEN_FMT, $details)
        ], Response::HTTP_FORBIDDEN);
    }

    public static function badRequest($details = null) {
        return response()->json([
            "message"    => self::BAD_REQUEST_MESSAGE,
            "data"      => $details
        ], Response::HTTP_BAD_REQUEST);
    }

    public static function created($details = null) {
        return response()->json([
            "message"    => self::SUCCESSFULLY_CREATED_MESSAGE,
            "data"       => $details
        ], Response::HTTP_CREATED);
    }

    public static function deleted($details = null) {
        return response()->json([
            "message"    => self::SUCCESSFULLY_DELETED_MESSAGE,
            "data"       => $details
        ], Response::HTTP_OK);
    }

    public static function updated($details = null) {
        return response()->json([
            "message"   => self::SUCCESSFULLY_UPDATED_MESSAGE,
            "data"      => $details
        ], Response::HTTP_OK);
    }

    public static function success($data = null, string $message = self::DEFAULT_SUCCESS_MESSAGE) {
        return response()->json([
            "message"    => $message,
            "data"       => $data
        ], Response::HTTP_OK);
    }

    public static function unprocessableEntity($data = null) {
        return response()->json([
            "message"    =>  self::UNPROCESSABLE_ENTITY_MESSAGE,
            "data"      => $data
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
