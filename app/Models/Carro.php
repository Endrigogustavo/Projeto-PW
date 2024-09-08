<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carro extends Model
{
    use HasFactory;
protected $table = 'carros'; // Nome da tabela, se diferente
    protected $fillable = [
        "modelo",
        "marca",
        "ano",
        "cambio",
        "ar-con",
        "cor",
        "combustivel",
        "placa",
        "Foto"
    ];

    // Método para obter a URL completa da capa do filme
    public function getfCarroUrlAttribute()
    {
        // Verifica se o atributo 'capa' existe
        if ($this->Foto) {
            // Retorna a URL completa da imagem da capa usando a função 'asset'
            // 'storage/' é o caminho onde as imagens são armazenadas no Laravel
            return asset('storage/' . $this->Foto);
        }
        // Retorna null se não houver uma imagem de capa associada
        return null;
    }
}
