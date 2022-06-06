<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dados;
use Excel;
use App\Imports\DadosImport;

class HomeController extends Controller
{
    public function home()
    {
        $data = [];
        return view('site.home', ['titulo' => 'Home (teste)'], compact('data'));
    }
    public function import(Request $request)
    {
        Excel::import(new DadosImport, $request->file);
        return redirect()->route('site.index');
    }
    public function filtragem(Request $request)
    {
        // $request->input('ad1');
        // $curso = $request->input('select_curso');
        // $disciplina = $request->input('select_disc');
        // $polo = $request->input('select_polo');
        // $media = $request->input('media');
        // $ad1 = $request->input('ad1');
        // $ap1 = $request->input('ap1');
        // $ad2 = $request->input('ad2');
        // $ap2 = $request->input('ap2');
        // $ap3 = $request->input('ap3');
        $data = [];

        $query = Dados::query();

            if ($request->select_curso){
                $query->where('codigo_curso', $request->select_curso);
            }

            if ($request->select_disc){
                $query->where('codigo_disciplina', $request->select_disc);
            }

            if ($request->select_polo) {
                $query->where('polo', $request->select_polo);
            }

            if ($request->media == 1){
                $query->where('ad1', '>=',5)
                ->orWhere('ap1', '>=',5)
                ->orWhere('ad2', '>=',5)
                ->orWhere('ap2', '>=',5)
                ->orWhere('ap3', '>=',5);
                
                if ($request->ad1) {
                    $query->where('ad1','>=',5);
                }
                if ($request->ap1) {
                    $query->where('ap1','>=',5);
                }
                if ($request->ad2) {
                    $query->where('ad2','>=',5);
                }
                if ($request->ap2) {
                    $query->where('ap2','>=',5);
                }
                if ($request->ap3) {
                    $query->where('ap3','>=',5);
                }


            }

            if ($request->media == 2){
                $query->where('ad1', '<',5)
                ->orWhere('ap1', '<',5)
                ->orWhere('ad2', '<',5)
                ->orWhere('ap2', '<',5)
                ->orWhere('ap3', '<',5);
                
                if ($request->ad1) {
                    $query->where('ad1','<',5);
                }
                if ($request->ap1) {
                    $query->where('ap1','<',5);
                }
                if ($request->ad2) {
                    $query->where('ad2','<',5);
                }
                if ($request->ap2) {
                    $query->where('ap2','<',5);
                }
                if ($request->ap3) {
                    $query->where('ap3','<',5);
                }


            }

            if ($request->media == 3){
                
                
                if ($request->ad1) {
                    $query->where('ad1', 0);
                }
                if ($request->ap1) {
                    $query->where('ap1', 0);
                }
                if ($request->ad2) {
                    $query->where('ad2', 0);
                }
                if ($request->ap2) {
                    $query->where('ap2', 0);
                }
                if ($request->ap3) {
                    $query->where('ap3', 0);
                }


            }



        $data = $query->get();




        // if (!empty($curso) && empty($disciplina) && empty($polo)) {
            
        //         if ($media == 1) {

        //             if ($request->ad1) {
        //                 # code...
        //             }
        //             else {
                        
                    
        //                 $data = Dados::where(function ($query) use ($curso, $disciplina, $polo) {
        //                     $query->where('codigo_curso', $curso);
        //                 })
        //                 ->where(function ($query) {
        //                     $query->where('ad1','>=', 5)
        //                         ->orWhere('ap1','>=', 5)
        //                         ->orWhere('ad2','>=', 5)
        //                         ->orWhere('ap2','>=', 5);
        //                 })->get();
        //             }

        //         } elseif ($media == 2) {
        //             $data = Dados::where(function ($query) use ($curso, $disciplina, $polo) {
        //                 $query->where('codigo_curso', $curso);
        //             })
        //             ->where(function ($query) {
        //                 $query->where('ad1','<', 5)
        //                     ->orWhere('ap1','<', 5)
        //                     ->orWhere('ad2','<', 5)
        //                     ->orWhere('ap2','<', 5);
        //             })->get();

        //         } elseif ($media == 3) {
        //             $data = Dados::where(function ($query) use ($curso, $disciplina, $polo) {
        //                 $query->where('codigo_curso', $curso);
        //             })
        //             ->where(function ($query) {
        //                 $query->where('ad1', 5)
        //                     ->orWhere('ap1', 5)
        //                     ->orWhere('ad2', 5)
        //                     ->orWhere('ap2', 5);
        //             })->get();

        //         } else {
        //             $data = Dados::where('codigo_curso', $curso)->get();
                    
        //         }

        // } elseif (!empty($curso) && !empty($disciplina) && empty($polo)) {

        //     if ($media == 1) {
        //         $data = Dados::where(function ($query) use ($curso, $disciplina, $polo) {
        //             $query->where('codigo_curso', $curso)
        //             ->where('codigo_disciplina', $disciplina);
        //         })
        //         ->where(function ($query) {
        //             $query->where('ad1','>=', 5)
        //                 ->orWhere('ap1','>=', 5)
        //                 ->orWhere('ad2','>=', 5)
        //                 ->orWhere('ap2','>=', 5);
        //         })->get();

        //     } elseif ($media == 2) {
        //         $data = Dados::where(function ($query) use ($curso, $disciplina, $polo) {
        //             $query->where('codigo_curso', $curso)
        //                 ->where('codigo_disciplina', $disciplina);
        //         })
        //         ->where(function ($query) {
        //             $query->where('ad1','<', 5)
        //                 ->orWhere('ap1','<', 5)
        //                 ->orWhere('ad2','<', 5)
        //                 ->orWhere('ap2','<', 5);
        //         })->get();

        //     } elseif ($media == 3) {
        //         $data = Dados::where(function ($query) use ($curso, $disciplina, $polo) {
        //             $query->where('codigo_curso', $curso)
        //             ->where('codigo_disciplina', $disciplina);
        //         })
        //         ->where(function ($query) {
        //             $query->where('ad1', 5)
        //                 ->orWhere('ap1', 5)
        //                 ->orWhere('ad2', 5)
        //                 ->orWhere('ap2', 5);
        //         })->get();

        //     } else {
        //         $data = Dados::where('codigo_curso', $curso)
        //         ->where('codigo_disciplina', $disciplina)->get();
                
        //     }
            
                
        // } elseif (!empty($curso) && !empty($disciplina) && !empty($polo)) {
            

        //         if ($media == 1) {
        //             $data = Dados::where(function ($query) use ($curso, $disciplina, $polo) {
        //                 $query->where('codigo_curso', $curso)
        //                 ->where('codigo_disciplina', $disciplina)
        //                 ->where('polo', $polo);

        //             })
        //             ->where(function ($query) {
        //                 $query->where('ad1','>=', 5)
        //                     ->orWhere('ap1','>=', 5)
        //                     ->orWhere('ad2','>=', 5)
        //                     ->orWhere('ap2','>=', 5);
        //             })->get();
    
        //         } elseif ($media == 2) {
        //             $data = Dados::where(function ($query) use ($curso, $disciplina, $polo) {
        //                $query->where('codigo_curso', $curso)
        //                 ->where('codigo_disciplina', $disciplina)
        //                 ->where('polo', $polo);
        //             })
        //             ->where(function ($query) {
        //                 $query->where('ad1','<', 5)
        //                     ->orWhere('ap1','<', 5)
        //                     ->orWhere('ad2','<', 5)
        //                     ->orWhere('ap2','<', 5);
        //             })->get();
    
        //         } elseif ($media == 3) {
        //             $data = Dados::where(function ($query) use ($curso, $disciplina, $polo) {
        //                 $query->where('codigo_curso', $curso)
        //                 ->where('codigo_disciplina', $disciplina)
        //                 ->where('polo', $polo);
        //             })
        //             ->where(function ($query) {
        //                 $query->where('ad1', 5)
        //                     ->orWhere('ap1', 5)
        //                     ->orWhere('ad2', 5)
        //                     ->orWhere('ap2', 5);
        //             })->get();
    
        //         } else {
        //             $data = Dados::where('codigo_curso', $curso)
        //                 ->where('codigo_disciplina', $disciplina)
        //                 ->where('polo', $polo)
        //                 ->get();
                    
        //         }

        // } elseif (empty($curso) && !empty($disciplina) && empty($polo)) {
            

        //     if ($media == 1) {
        //         $data = Dados::where(function ($query) use ($curso, $disciplina, $polo) {
        //             $query->where('codigo_disciplina', $disciplina);
        //         })
        //         ->where(function ($query) {
        //             $query->where('ad1','>=', 5)
        //                 ->orWhere('ap1','>=', 5)
        //                 ->orWhere('ad2','>=', 5)
        //                 ->orWhere('ap2','>=', 5);
        //         })->get();
    
        //     } elseif ($media == 2) {
        //         $data = Dados::where(function ($query) use ($curso, $disciplina, $polo) {
        //             $query->where('codigo_disciplina', $disciplina);
        //         })
        //         ->where(function ($query) {
        //             $query->where('ad1','<', 5)
        //                 ->orWhere('ap1','<', 5)
        //                 ->orWhere('ad2','<', 5)
        //                 ->orWhere('ap2','<', 5);
        //         })->get();
    
        //     } elseif ($media == 3) {
        //         $data = Dados::where(function ($query) use ($curso, $disciplina, $polo) {
        //             $query->where('codigo_disciplina', $disciplina);
        //         })
        //         ->where(function ($query) {
        //             $query->where('ad1', 5)
        //                 ->orWhere('ap1', 5)
        //                 ->orWhere('ad2', 5)
        //                 ->orWhere('ap2', 5);
        //         })->get();
    
        //     } else {
        //         $data = Dados::where('codigo_disciplina', $disciplina)->get();
        //     }
            

        // } elseif (empty($curso) && !empty($disciplina) && !empty($polo)) {
            

        //         if ($media == 1) {
        //             $data = Dados::where(function ($query) use ($curso, $disciplina, $polo) {
        //                 $query->where('codigo_disciplina', $disciplina)
        //                 ->where('polo', $polo);
        //             })
        //             ->where(function ($query) {
        //                 $query->where('ad1','>=', 5)
        //                     ->orWhere('ap1','>=', 5)
        //                     ->orWhere('ad2','>=', 5)
        //                     ->orWhere('ap2','>=', 5);
        //             })->get();
        
        //         } elseif ($media == 2) {
        //             $data = Dados::where(function ($query) use ($curso, $disciplina, $polo) {
        //                 $query->where('codigo_disciplina', $disciplina)
        //                 ->where('polo', $polo);
        //             })
        //             ->where(function ($query) {
        //                 $query->where('ad1','<', 5)
        //                     ->orWhere('ap1','<', 5)
        //                     ->orWhere('ad2','<', 5)
        //                     ->orWhere('ap2','<', 5);
        //             })->get();
        
        //         } elseif ($media == 3) {
        //             $data = Dados::where(function ($query) use ($curso, $disciplina, $polo) {
        //                 $query->where('codigo_disciplina', $disciplina)
        //                 ->where('polo', $polo);
        //             })
        //             ->where(function ($query) {
        //                 $query->where('ad1', 5)
        //                     ->orWhere('ap1', 5)
        //                     ->orWhere('ad2', 5)
        //                     ->orWhere('ap2', 5);
        //             })->get();
        
        //         } else {
        //             $data = Dados::where('codigo_disciplina', $disciplina)
        //                 ->where('polo', $polo)->get();
        //         }

        // } elseif (empty($curso) && empty($disciplina) && !empty($polo)) {
            

        //     if ($media == 1) {
        //         $data = Dados::where(function ($query) use ($curso, $disciplina, $polo) {
        //             $query->where('polo', $polo);
        //         })
        //         ->where(function ($query) {
        //             $query->where('ad1','>=', 5)
        //                 ->orWhere('ap1','>=', 5)
        //                 ->orWhere('ad2','>=', 5)
        //                 ->orWhere('ap2','>=', 5);
        //         })->get();
    
        //     } elseif ($media == 2) {
        //         $data = Dados::where(function ($query) use ($curso, $disciplina, $polo) {
        //             $query->where('polo', $polo);
        //         })
        //         ->where(function ($query) {
        //             $query->where('ad1','<', 5)
        //                 ->orWhere('ap1','<', 5)
        //                 ->orWhere('ad2','<', 5)
        //                 ->orWhere('ap2','<', 5);
        //         })->get();
    
        //     } elseif ($media == 3) {
        //         $data = Dados::where(function ($query) use ($curso, $disciplina, $polo) {
        //             $query->where('polo', $polo);
        //         })
        //         ->where(function ($query) {
        //             $query->where('ad1', 5)
        //                 ->orWhere('ap1', 5)
        //                 ->orWhere('ad2', 5)
        //                 ->orWhere('ap2', 5);
        //         })->get();
    
        //     } else {
        //         $data = Dados::where('polo', $polo)->get();
        //     }

        // } elseif (!empty($curso) && empty($disciplina) && !empty($polo)) {
        //     $data = Dados::where('codigo_curso', $curso)
        //         ->where('polo', $polo)->get();

        //         if ($media == 1) {
        //             $data = Dados::where(function ($query) use ($curso, $disciplina, $polo) {
        //                 $query->where('codigo_curso', $curso)
        //                 ->where('polo', $polo);
        //             })
        //             ->where(function ($query) {
        //                 $query->where('ad1','>=', 5)
        //                     ->orWhere('ap1','>=', 5)
        //                     ->orWhere('ad2','>=', 5)
        //                     ->orWhere('ap2','>=', 5);
        //             })->get();
        
        //         } elseif ($media == 2) {
        //             $data = Dados::where(function ($query) use ($curso, $disciplina, $polo) {
        //                 $query->where('codigo_curso', $curso)
        //                 ->where('polo', $polo);
        //             })
        //             ->where(function ($query) {
        //                 $query->where('ad1','<', 5)
        //                     ->orWhere('ap1','<', 5)
        //                     ->orWhere('ad2','<', 5)
        //                     ->orWhere('ap2','<', 5);
        //             })->get();
        
        //         } elseif ($media == 3) {
        //             $data = Dados::where(function ($query) use ($curso, $disciplina, $polo) {
        //                 $query->where('codigo_curso', $curso)
        //                 ->where('polo', $polo);
        //             })
        //             ->where(function ($query) {
        //                 $query->where('ad1', 5)
        //                     ->orWhere('ap1', 5)
        //                     ->orWhere('ad2', 5)
        //                     ->orWhere('ap2', 5);
        //             })->get();
        
        //         } else {
        //             $data = Dados::where('codigo_curso', $curso)
        //         ->where('polo', $polo)->get();
        //         }
        
        

        // }






        
        return view('site.home', ['titulo' => 'Home (teste)'], compact('data'));
    }
}
