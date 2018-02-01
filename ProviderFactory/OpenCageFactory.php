<?php

declare(strict_types=1);

/*
 * This file is part of the BazingaGeocoderBundle package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license    MIT License
 */

namespace Bazinga\GeocoderBundle\ProviderFactory;

use Geocoder\Provider\OpenCage\OpenCage;
use Geocoder\Provider\Provider;
use Http\Discovery\HttpClientDiscovery;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class OpenCageFactory extends AbstractFactory
{
    protected static $dependencies = [
        ['requiredClass' => OpenCage::class, 'packageName' => 'geocoder-php/open-cage-provider'],
    ];

    protected function getProvider(array $config): Provider
    {
        $httplug = $config['httplug_client'] ?: HttpClientDiscovery::find();

        return new OpenCage($httplug, $config['api_key']);
    }

    protected static function configureOptionResolver(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'httplug_client' => null,
        ]);

        $resolver->setRequired('api_key');
        $resolver->setAllowedTypes('httplug_client', ['object', 'null']);
        $resolver->setAllowedTypes('api_key', ['string']);
    }
}
