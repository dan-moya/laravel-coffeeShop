<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoriaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** Usualmente aquí es donde definimos qué columnas son las que se van a retornar y qué llaves vamos a tener. */
        /** Básicamente tenemos el control total de lo que queremos retornar en las respuestas JSON, por ej, podemos retonar atributos combinados, es decir, nombre_id (este campo no existe en la BD, pero se lo puede pasar) => $this->id . " - " . $this->nombre */
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            //'nombre_id' => $this->id . " - " . $this->nombre,
            'icono' => $this->icono,
        ];
    }
}
