<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    protected $fillable = ['address', 'image', 'company', 'footer', 'phone_number'];

    /**
     * Hilo de la pregunta como hacer la altura dinamica en dompdf
     * https://github.com/dompdf/dompdf/issues/1524
     */
    public function getBodyHeight($dompdf)
    {
        $GLOBALS['bodyHeight'] = 0;
        $dompdf->setCallbacks(
            array(
                'myCallbacks' => array(
                    'event' => 'end_frame',
                    'f' => function (\Dompdf\Frame $frame) { //function ($infos) {
                        //  $frame = $infos["frame"];
                        if (strtolower($frame->get_node()->nodeName) === "body") {
                            $padding_box = $frame->get_padding_box();
                            $GLOBALS['bodyHeight'] += $padding_box['h'];
                        }
                    }
                )
            )
        );
        $dompdf->render();
        unset($dompdf);
        return $GLOBALS['bodyHeight'];
    }
}
