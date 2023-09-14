<?php

namespace App\Factory;

use Psr\Container\ContainerInterface;
use Cloudinary\Cloudinary;
use Cloudinary\Configuration\Configuration;

class CloudinaryFactory
{
    public function __invoke(ContainerInterface $container): Cloudinary
    {
        $config = $container->get('config')['cloudinary'];


        // Access the configuration values
        $cloudName = $config['cloud_name'];
        $apiKey = $config['api_key'];
        $apiSecret = $config['api_secret'];
        $secure = $config['secure'];

        $config = Configuration::instance();
        $config->cloud->cloudName = $cloudName;
        $config->cloud->apiKey = $apiKey;
        $config->cloud->apiSecret = $apiSecret;
        $config->url->secure = false;

        // Use the configuration values to create the Cloudinary instance
        return new Cloudinary($config);
    }
}
