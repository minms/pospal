<?php
/**
 * User: minms
 */

namespace minms\pospal\pimple;

class PospalException extends \Exception
{
    /**
     * @return string the user-friendly name of this exception
     */
    public function getName()
    {
        return 'PospalException';
    }
}