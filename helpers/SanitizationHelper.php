<?php

class SanitizationHelper
{
    public function sanitize($data){
        $sanitizedData = $this->sanitizeArrayRecursive($data);

        return $sanitizedData;
    }

    private function sanitizeArrayRecursive($data)
    {
        foreach ($data as $key => $value) {
            if (!is_null($value) && is_array($value)) {
                $data[$key] = $this->sanitizeArrayRecursive($value);
            } else {
                $data[$key] = $this->passes($value);
            }
        }

        return $data;
    }

    /**
     * Sanitize the input value.
     *
     * @return string The sanitized value.
     */
    private function passes($value): string
    {
        $sanitizedValue = $value;

        $sanitizedValue = strip_tags($sanitizedValue);

        $sanitizedValue = $this->removeJavascript($sanitizedValue);

        $sanitizedValue = $this->removeSqlInjection($sanitizedValue);

        $sanitizedValue = trim($sanitizedValue);

        return $sanitizedValue;
    }

    /**
     * Remove JavaScript tags from the input value.
     *
     * @param string $value The value to remove JavaScript tags from.
     * @return string The value with JavaScript tags removed.
     */
    private function removeJavascript(string $value): string
    {
        $pattern = '/<script\b[^>]*>(.*?)<\/script>/is';
        $sanitizedValue = preg_replace($pattern, '', $value);

        return $sanitizedValue;
    }

    /**
     * Remove SQL injection keywords and characters from the input value.
     *
     * @param string $value The value to remove SQL injection keywords from.
     * @return string The value with SQL injection keywords removed.
     */
    private function removeSqlInjection(string $value): string
    {
        $sqlKeywords = [
            'SELECT', 'INSERT', 'UPDATE', 'DELETE', 'DROP', 'UNION', 'ALTER', 'TRUNCATE', 'CREATE'
        ];

        foreach ($sqlKeywords as $keyword) {
            $value = str_ireplace($keyword, '', $value);
        }

        $value = str_replace(['--', ';'], '', $value);

        return $value;
    }

}