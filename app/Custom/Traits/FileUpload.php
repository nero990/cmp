<?php

namespace App\Custom\Traits;


trait FileUpload
{

    /**
     * @param $headings
     * @return string
     */
    public static function validateHeadings($headings)
    {
        $missing_headings = [];
        foreach (static::getRequiredHeadings() AS $heading) {
            if(!in_array($heading, $headings)) {
                $missing_headings[] = normal_case($heading);
            }
        }

        if(!empty($missing_headings)){
            $fields = join(', ', $missing_headings);
            $message = "File upload failed, because ";
            $message .= (count($missing_headings) > 1) ? "the following headers are missing: <b>{$fields}</b>" : "the <b>{$fields}</b> header is missing.";

            return $message;
        }
        return "";
    }

    /**
     * @return array
     */
    public static function getRequiredHeadings(): array
    {
        return self::$required_headings;
    }

    /**
     * @return string
     */
    public static function getRequiredHeadingsAsString(): string
    {
        return implode(",", static::getRequiredHeadings());
    }
}