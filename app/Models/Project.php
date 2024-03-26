<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable =['title', 'description', 'image','slug','is_completed', 'type_id'];


    //funzione per cambiare il format delle date
    public function getFormattedDate($column, $format = 'd-m-Y')
    {
        return Carbon::create($this->$column)->format($format);
    }
    
    //funzione per stampare un icona al posto del pubblicato o non
    public function completeIcon()
    {
        return $this->is_completed ? "<i class='fa-solid fa-circle-check fa-xl' style='color: #2b9b1c;'></i>" : "<i class='fa-solid fa-circle-xmark fa-xl' style='color: #da1616;'></i>";
    }
    
    //funzione per centralizzare il percorso dell'immagine per arrivare allo storage
    public function printImage()
    {
        return asset('storage/' . $this->image);
    }

    //Ogni Progetto può avere un solo type
    public function type()
    {
        return $this->belongsTo(Type::class);
    }
}
