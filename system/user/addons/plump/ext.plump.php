<?php

if ( !defined('BASEPATH')) exit('No direct script access allowed');

class Plump_ext
{
    /**
     * @var array
     */
    public $settings = [];

    /**
     * @var string
     */
    public $description = PLUMP_DESC;

    /**
     * @var string
     */
    public $docs_url = PLUMP_DOCS;

    /**
     * @var string
     */
    public $name = PLUMP_NAME;

    /**
     * @var integer
     */
    public $version = PLUMP_VERSION;

    /**
     * @var string
     */
    public $settings_exist = 'n';

    /**
     * @var array
     */
    public $required_by = [];

    //public function __construct() {}

    /**
     * @return string
     */
    public function cp_css_end()
    {
        $styles = '';

        // If another extension shares the same hook
        if (ee()->extensions->last_call !== FALSE) {
            $styles .= ee()->extensions->last_call;
        }

        $styles .= file_get_contents(PATH_THIRD_THEMES .'plump/styles/cp.css');

        return $styles;
    }

    /**
     * Install the extension
     */
    public function activate_extension()
    {
        $this->deleteHooks();

        // Add new hooks
        $ext_template = [
            'class'    => PLUMP_EXT,
            'settings' => '',
            'priority' => 5,
            'version'  => PLUMP_VERSION,
            'enabled'  => 'y'
        ];

        $extensions = [
            ['hook' => 'cp_css_end', 'method' => 'cp_css_end'],
        ];

        foreach($extensions as $extension) {
            $ext = array_merge($ext_template, $extension);
            $hook = ee('Model')->make('Extension', $ext);
            $hook->save();
        }
    }

    /**
     * @param string $current currently installed version
     */
    public function update_extension($current = '') {}

    /**
     * Uninstalls extension
     */
    public function disable_extension()
    {
        $this->deleteHooks();
    }

    /**
     * Remove all hooks for this extension from the db
     */
    private function deleteHooks()
    {
        /** @var \EllisLab\ExpressionEngine\Model\Addon\Extension $ext */
        $extensionModel = ee('Model')->get('Extension');
        $extensions = $extensionModel
            ->filter('class', PLUMP_EXT)
            ->all();

        // Delete old hooks
        foreach ($extensions as $ext) {
            $ext->delete();
        }
    }
}
