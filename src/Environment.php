<?php

namespace NatanaelOliveira\DotEnv;

/**
 * Class Environment
 *
 * Manages environment variables in an .env file.
 */
class Environment
{
    /** @var string The path to the .env file */
    private $envFile;

    /**
     * Class constructor.
     *
     * @param string $envFile The path to the .env file (optional, default is '.env')
     */
    public function __construct($envFile = '.env')
    {
        $this->envFile = $envFile;

        // Create .env file if it doesn't exist
        if (!file_exists($this->envFile)) {
            touch($this->envFile);
        }
    }

    /**
     * Sets an environment variable.
     *
     * @param string $key The key of the environment variable
     * @param string $value The value of the environment variable
     */
    public function set($key, $value)
    {
        $envData = $this->readEnvFile();
        $envData[$key] = $value;
        $this->writeEnvFile($envData);
    }

    /**
     * Gets the value of an environment variable.
     *
     * @param string $key The key of the environment variable
     * @param mixed  $defaultValue The default value if the key does not exist (optional)
     *
     * @return mixed The environment variable value or the default value
     */
    public function get($key, $defaultValue = null)
    {
        $envData = $this->readEnvFile();
        return isset($envData[$key]) ? $envData[$key] : $defaultValue;
    }

    /**
     * Removes an environment variable.
     *
     * @param string $key The key of the environment variable to remove
     */
    public function remove($key)
    {
        $envData = $this->readEnvFile();
        if (isset($envData[$key])) {
            unset($envData[$key]);
            $this->writeEnvFile($envData);
        }
    }

    /**
     * Reads the contents of the .env file and converts it to an array of environment variables.
     *
     * @return array An associative array of environment variables
     */
    private function readEnvFile()
    {
        $contents = file_get_contents($this->envFile);
        $lines = explode("\n", $contents);
        $envData = [];

        foreach ($lines as $line) {
            $line = trim($line);
            if (!empty($line) && strpos($line, '=') !== false) {
                list($key, $value) = explode('=', $line, 2);
                $envData[trim($key)] = trim($value);
            }
        }

        return $envData;
    }

    /**
     * Writes an array of environment variables to the .env file.
     *
     * @param array $envData An associative array of environment variables
     */
    private function writeEnvFile($envData)
    {
        $contents = '';
        foreach ($envData as $key => $value) {
            $contents .= "$key=$value\n";
        }
        file_put_contents($this->envFile, $contents);
    }
}
