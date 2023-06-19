<?php

namespace App\Exports;

use App\Models\diagrama;

use Carbon\Carbon;
use App\Models\User;
use App\Models\clase;
use App\Models\sintaxi;
use App\Models\atributo;
use App\Models\invitado;
use App\Models\relation;
use App\Models\tipo_dato;
use App\Exports\DatosExport;
use Illuminate\Http\Request;
use App\Models\relation_tipo;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

// class UsuariosExport implements FromCollection
class UsuariosExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        $d = Request('d');
        $array_atributo = [];
        $array_relacion = [];
        $array_clase = [];
        $di = diagrama::where('id', '=', $d->id)->first();
        $c = clase::where('id_diagrama', '=', $d->id)->get();
        foreach ($c as $cl) {



            $re = relation::where('clase_origen', '=', $cl->id)->get();
            foreach ($re as $r) {
                $relxd = relation::where('clase_origen', '=', $r->clase_origen)->first();
                $tr = relation_tipo::where('id', '=', $relxd->tipo_relacion)->first();



                $clasO = clase::where('id', '=', $relxd->clase_origen)->first();
                $clasD = clase::where('id', '=', $relxd->clase_destino)->first();
                $array_relacion[$relxd->id] = [
                    "clase_origen" => $clasO->name,
                    "clase_destino" => $clasD->name,
                    "tipo_relacion" => $tr->name,
                ];
            }

            $at = atributo::where('clase_id', '=', $cl->id)->get();
            foreach ($at as $a) {
                $td = tipo_dato::where('id', '=', $a->tipo_id)->first();
                $array_atributo[$a->id] = [
                    "atributo_name" => $a->name,
                    "tipo_dato_name" => $td->name,
                ];
            }
            // dd($array_atributo);

            if ($re->where('clase_origen', '=', $cl->id)->first()) {
                $array_clase[$cl->id] = [
                    "clase_name" => $cl->name,
                    "atributos" => $array_atributo,
                    "relaciones" => $array_relacion,
                ];

                $array_atributo = [];
                $array_relacion = [];
            } else {
                $array_clase[$cl->id] = [
                    "clase_name" => $cl->name,
                    "atributos" => $array_atributo,
                    "relaciones" => null,
                ];
                $array_atributo = [];
            }
        }
        return view('VistaDiagramas.postgresql', compact('array_clase', 'di'));
    }
}
