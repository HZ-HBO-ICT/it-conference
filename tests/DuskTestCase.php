<?php

namespace Tests;

use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Firefox\FirefoxOptions;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Illuminate\Support\Collection;
use Laravel\Dusk\TestCase as BaseTestCase;
use PHPUnit\Framework\Attributes\BeforeClass;

abstract class DuskTestCase extends BaseTestCase
{
    /**
     * Prepare for Dusk test execution.
     */
    #[BeforeClass]
    public static function prepare(): void
    {
        if (!static::runningInSail()) {
            static::startChromeDriver();
        }
    }

    /**
     * Create the RemoteWebDriver instance.
     */
    protected function driver(): RemoteWebDriver
    {
        $browser = env('BROWSER_TYPE', 'chrome');

        switch ($browser) {
            case 'firefox':
                $options = new FirefoxOptions();
                $capabilities = DesiredCapabilities::firefox()->setCapability(
                    FirefoxOptions::CAPABILITY, $options
                );
                break;

            case 'chrome':
            default:
                $options = new ChromeOptions();
                $capabilities = DesiredCapabilities::chrome()->setCapability(
                    ChromeOptions::CAPABILITY, $options
                );
                break;
        }
        return RemoteWebDriver::create('http://selenium:4444/wd/hub', $capabilities);
    }
}
