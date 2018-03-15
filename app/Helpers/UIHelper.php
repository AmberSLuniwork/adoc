<?php
/**
 * Contains the UIHelper class
 *
 * PHP Version 5
 *
 * @package ADoc\Helpers
 * @author  Mark Hall <Mark.Hall@edgehill.ac.uk>
 * @license https://gnu.org/licenses/agpl.html GNU Affero General Public License
 */

namespace ADoc\Helpers;

/**
 * The UIHelper provides helper functionality used by the Blade template views.
 *
 * @package ADoc\Helpers
 */
class UIHelper
{
    /**
     * Generates the JSON structure used by the jQuery postLink plugin to configure
     * its confirmation dialog box.
     *
     * @param string $title        The title of the dialog box
     * @param string $message      The message to show in the dialog box
     * @param string $cancel_label The label of the cancel button
     * @param string $ok_label     The label of the ok button
     * @param string $cancel_class The CSS class of the cancel button
     * @param string $ok_class     The CSS class of the ok button
     *
     * @return string The settings array as a JSON string, escaped for use in a tag attribute
     */
    public function confirmSettings($title, $message, $cancel_label, $ok_label, $cancel_class, $ok_class)
    {
        $settings = [
            'title' => $title,
            'msg' => $message,
            'ok' => ['label' => $ok_label],
            'cancel' => ['label' => $cancel_label]];
        if ($cancel_class !== null) {
            $settings['cancel']['class_'] = $cancel_class;
        }
        if ($ok_class !== null) {
            $settings['ok']['class_'] = $ok_class;
        }
        return str_replace(['&', '"'], ['&amp;', '&quot;'], json_encode($settings));
    }
    
    /**
     * Generates the confirmation settings for performing an action on an object that is used by
     * the jQuery postLink plugin to show an confirmation dialog box.
     *
     * @param string $action The action that is to be confirmed
     * @param string $type   The type of object to apply the action to
     * @param string $label  The label of the object to apply the action to
     *
     * @return string The settings array as a JSON string, escaped for use in a tag attribute
     */
    public function confirmActionSettings($action, $type, $label)
    {
        return $this->confirmSettings(
            ucfirst($action) . ' ' .  ucwords($type),
            'Please confirm that you wish to ' . $action . ' the ' . $type . ' <em>' . $label . '</em>.',
            "Don't " . $action,
            ucfirst($action),
            'secondary',
            'alert'
        );
    }
    
    /**
     * Generates the confirmation settings for deleting an object that is used by
     * the jQuery postLink plugin to show an confirmation dialog box.
     *
     * @param string $type  The type of object to delete
     * @param string $label The label of the object to delete
     *
     * @return string The settings array as a JSON string, escaped for use in a tag attribute
     */
    public function confirmDeleteSettings($type, $label)
    {
        return $this->confirmActionSettings('delete', $type, $label);
    }
}
