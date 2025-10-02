<?php

class DateFormatExtension extends Minz_Extension {
    private const DEFAULT_RELATIVE_DATE = false;
    private const DEFAULT_ADJUSTED_DATE = false;
    private const DEFAULT_HOUR12_DATE = false;
    private const DEFAULT_CUSTOM_FORMAT = null;

    public function init(): void {
        $this->registerTranslates();

        Minz_View::appendScript($this->getFileUrl('moment-with-locales.js', 'js'));
        Minz_View::appendScript($this->getFileUrl('date-format.js', 'js'));

        if (version_compare(FRESHRSS_VERSION, 1.28) >= 0) {
            $this->registerHook(Minz_HookType::JsVars, [$this, 'addVariables']);
        } else {
            $this->registerHook('js_vars', [$this, 'addVariables']);
        }
    }

    public function addVariables($vars): array {
        $vars[$this->getName()]['configuration'] = [
            'relativeDates' => $this->getRelativeDates(),
            'adjustedDates' => $this->getAdjustedDates(),
            'hour12Dates' => $this->getHour12Dates(),
            'customFormat' => $this->getCustomFormat(),
        ];

        return $vars;
    }

    public function handleConfigureAction(): void {
        $this->registerTranslates();

        if (Minz_Request::isPost()) {
            $configuration = [
                'relativeDates' => Minz_Request::paramBoolean('relative-dates'),
                'adjustedDates' => Minz_Request::paramBoolean('adjusted-dates'),
                'hour12Dates' => Minz_Request::paramBoolean('hour12-dates'),
                'customFormat' => Minz_Request::paramStringNull('custom-format'),
            ];
            $this->setUserConfiguration($configuration);
        }
    }

    public function getRelativeDates(): bool {
        return $this->getUserConfigurationValue('relativeDates', static::DEFAULT_RELATIVE_DATE);
    }

    public function getAdjustedDates(): bool {
        return $this->getUserConfigurationValue('adjustedDates', static::DEFAULT_ADJUSTED_DATE);
    }

    public function getHour12Dates(): bool {
        return $this->getUserConfigurationValue('hour12Dates', static::DEFAULT_HOUR12_DATE);
    }

    public function getCustomFormat(): ?string {
        return $this->getUserConfigurationValue('customFormat', static::DEFAULT_CUSTOM_FORMAT);
    }
}