<?php

namespace App\Traits\Admin;

use App\Models\Configuracion;

trait ConfiguracionTrait
{
    public function getConfiguracionesGenerales()
    {
        $configuraciones = $this->whereIn('id', [
            Configuracion::NOMBRE_APLICACION,
            Configuracion::EMAIL_APLICACION,
            Configuracion::TELEFONO_APLICACION,
            Configuracion::ESLOGAN,
            Configuracion::FONDO_LOGIN_TEMA_CLARO,
            Configuracion::FONDO_LOGIN_TEMA_OSCURO,
            Configuracion::LOGO
        ])->get();

        $data = [];

        foreach ($configuraciones as $configuracion) {
            if (
                in_array($configuracion->id, [
                    Configuracion::FONDO_LOGIN_TEMA_CLARO,
                    Configuracion::FONDO_LOGIN_TEMA_OSCURO,
                    Configuracion::LOGO
                ])
            ) {
                if ($configuracion->media->isNotEmpty()) {
                    $data[$configuracion->key] = $configuracion->media->last()->getUrl();
                    continue;
                }
            }

            $data[$configuracion->key] = $configuracion->value;
        }

        return $data;
    }

}
