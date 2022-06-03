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

        $curso = $request->input('select_curso');
        $disciplina = $request->input('select_disc');
        $polo = $request->input('select_polo');
        $media = $request->input('media');

        $data = [];



        if (!empty($curso) && empty($disciplina) && empty($polo)) {
            
                if ($media == 1) {
                    $data = Dados::where(function ($query) use ($curso, $disciplina, $polo) {
                        $query->where('codigo_curso', $curso);
                    })
                    ->where(function ($query) {
                        $query->where('ad1','>=', 5)
                            ->orWhere('ap1','>=', 5)
                            ->orWhere('ad2','>=', 5)
                            ->orWhere('ap2','>=', 5);
                    })->get();

                } elseif ($media == 2) {
                    $data = Dados::where(function ($query) use ($curso, $disciplina, $polo) {
                        $query->where('codigo_curso', $curso);
                    })
                    ->where(function ($query) {
                        $query->where('ad1','<', 5)
                            ->orWhere('ap1','<', 5)
                            ->orWhere('ad2','<', 5)
                            ->orWhere('ap2','<', 5);
                    })->get();

                } elseif ($media == 3) {
                    $data = Dados::where(function ($query) use ($curso, $disciplina, $polo) {
                        $query->where('codigo_curso', $curso);
                    })
                    ->where(function ($query) {
                        $query->where('ad1', 5)
                            ->orWhere('ap1', 5)
                            ->orWhere('ad2', 5)
                            ->orWhere('ap2', 5);
                    })->get();

                } else {
                    $data = Dados::where('codigo_curso', $curso)->get();
                    
                }

        } elseif (!empty($curso) && !empty($disciplina) && empty($polo)) {

            if ($media == 1) {
                $data = Dados::where(function ($query) use ($curso, $disciplina, $polo) {
                    $query->where('codigo_curso', $curso)
                    ->where('codigo_disciplina', $disciplina);
                })
                ->where(function ($query) {
                    $query->where('ad1','>=', 5)
                        ->orWhere('ap1','>=', 5)
                        ->orWhere('ad2','>=', 5)
                        ->orWhere('ap2','>=', 5);
                })->get();

            } elseif ($media == 2) {
                $data = Dados::where(function ($query) use ($curso, $disciplina, $polo) {
                    $query->where('codigo_curso', $curso)
                        ->where('codigo_disciplina', $disciplina);
                })
                ->where(function ($query) {
                    $query->where('ad1','<', 5)
                        ->orWhere('ap1','<', 5)
                        ->orWhere('ad2','<', 5)
                        ->orWhere('ap2','<', 5);
                })->get();

            } elseif ($media == 3) {
                $data = Dados::where(function ($query) use ($curso, $disciplina, $polo) {
                    $query->where('codigo_curso', $curso)
                    ->where('codigo_disciplina', $disciplina);
                })
                ->where(function ($query) {
                    $query->where('ad1', 5)
                        ->orWhere('ap1', 5)
                        ->orWhere('ad2', 5)
                        ->orWhere('ap2', 5);
                })->get();

            } else {
                $data = Dados::where('codigo_curso', $curso)
                ->where('codigo_disciplina', $disciplina)->get();
                
            }
            
                
        } elseif (!empty($curso) && !empty($disciplina) && !empty($polo)) {
            

                if ($media == 1) {
                    $data = Dados::where(function ($query) use ($curso, $disciplina, $polo) {
                        $query->where('codigo_curso', $curso)
                        ->where('codigo_disciplina', $disciplina)
                        ->where('polo', $polo);

                    })
                    ->where(function ($query) {
                        $query->where('ad1','>=', 5)
                            ->orWhere('ap1','>=', 5)
                            ->orWhere('ad2','>=', 5)
                            ->orWhere('ap2','>=', 5);
                    })->get();
    
                } elseif ($media == 2) {
                    $data = Dados::where(function ($query) use ($curso, $disciplina, $polo) {
                       $query->where('codigo_curso', $curso)
                        ->where('codigo_disciplina', $disciplina)
                        ->where('polo', $polo);
                    })
                    ->where(function ($query) {
                        $query->where('ad1','<', 5)
                            ->orWhere('ap1','<', 5)
                            ->orWhere('ad2','<', 5)
                            ->orWhere('ap2','<', 5);
                    })->get();
    
                } elseif ($media == 3) {
                    $data = Dados::where(function ($query) use ($curso, $disciplina, $polo) {
                        $query->where('codigo_curso', $curso)
                        ->where('codigo_disciplina', $disciplina)
                        ->where('polo', $polo);
                    })
                    ->where(function ($query) {
                        $query->where('ad1', 5)
                            ->orWhere('ap1', 5)
                            ->orWhere('ad2', 5)
                            ->orWhere('ap2', 5);
                    })->get();
    
                } else {
                    $data = Dados::where('codigo_curso', $curso)
                        ->where('codigo_disciplina', $disciplina)
                        ->where('polo', $polo)
                        ->get();
                    
                }

        } elseif (empty($curso) && !empty($disciplina) && empty($polo)) {
            

            if ($media == 1) {
                $data = Dados::where(function ($query) use ($curso, $disciplina, $polo) {
                    $query->where('codigo_disciplina', $disciplina);
                })
                ->where(function ($query) {
                    $query->where('ad1','>=', 5)
                        ->orWhere('ap1','>=', 5)
                        ->orWhere('ad2','>=', 5)
                        ->orWhere('ap2','>=', 5);
                })->get();
    
            } elseif ($media == 2) {
                $data = Dados::where(function ($query) use ($curso, $disciplina, $polo) {
                    $query->where('codigo_disciplina', $disciplina);
                })
                ->where(function ($query) {
                    $query->where('ad1','<', 5)
                        ->orWhere('ap1','<', 5)
                        ->orWhere('ad2','<', 5)
                        ->orWhere('ap2','<', 5);
                })->get();
    
            } elseif ($media == 3) {
                $data = Dados::where(function ($query) use ($curso, $disciplina, $polo) {
                    $query->where('codigo_disciplina', $disciplina);
                })
                ->where(function ($query) {
                    $query->where('ad1', 5)
                        ->orWhere('ap1', 5)
                        ->orWhere('ad2', 5)
                        ->orWhere('ap2', 5);
                })->get();
    
            } else {
                $data = Dados::where('codigo_disciplina', $disciplina)->get();
            }
            

        } elseif (empty($curso) && !empty($disciplina) && !empty($polo)) {
            

                if ($media == 1) {
                    $data = Dados::where(function ($query) use ($curso, $disciplina, $polo) {
                        $query->where('codigo_disciplina', $disciplina)
                        ->where('polo', $polo);
                    })
                    ->where(function ($query) {
                        $query->where('ad1','>=', 5)
                            ->orWhere('ap1','>=', 5)
                            ->orWhere('ad2','>=', 5)
                            ->orWhere('ap2','>=', 5);
                    })->get();
        
                } elseif ($media == 2) {
                    $data = Dados::where(function ($query) use ($curso, $disciplina, $polo) {
                        $query->where('codigo_disciplina', $disciplina)
                        ->where('polo', $polo);
                    })
                    ->where(function ($query) {
                        $query->where('ad1','<', 5)
                            ->orWhere('ap1','<', 5)
                            ->orWhere('ad2','<', 5)
                            ->orWhere('ap2','<', 5);
                    })->get();
        
                } elseif ($media == 3) {
                    $data = Dados::where(function ($query) use ($curso, $disciplina, $polo) {
                        $query->where('codigo_disciplina', $disciplina)
                        ->where('polo', $polo);
                    })
                    ->where(function ($query) {
                        $query->where('ad1', 5)
                            ->orWhere('ap1', 5)
                            ->orWhere('ad2', 5)
                            ->orWhere('ap2', 5);
                    })->get();
        
                } else {
                    $data = Dados::where('codigo_disciplina', $disciplina)
                        ->where('polo', $polo)->get();
                }

        } elseif (empty($curso) && empty($disciplina) && !empty($polo)) {
            

            if ($media == 1) {
                $data = Dados::where(function ($query) use ($curso, $disciplina, $polo) {
                    $query->where('polo', $polo);
                })
                ->where(function ($query) {
                    $query->where('ad1','>=', 5)
                        ->orWhere('ap1','>=', 5)
                        ->orWhere('ad2','>=', 5)
                        ->orWhere('ap2','>=', 5);
                })->get();
    
            } elseif ($media == 2) {
                $data = Dados::where(function ($query) use ($curso, $disciplina, $polo) {
                    $query->where('polo', $polo);
                })
                ->where(function ($query) {
                    $query->where('ad1','<', 5)
                        ->orWhere('ap1','<', 5)
                        ->orWhere('ad2','<', 5)
                        ->orWhere('ap2','<', 5);
                })->get();
    
            } elseif ($media == 3) {
                $data = Dados::where(function ($query) use ($curso, $disciplina, $polo) {
                    $query->where('polo', $polo);
                })
                ->where(function ($query) {
                    $query->where('ad1', 5)
                        ->orWhere('ap1', 5)
                        ->orWhere('ad2', 5)
                        ->orWhere('ap2', 5);
                })->get();
    
            } else {
                $data = Dados::where('polo', $polo)->get();
            }

        } elseif (!empty($curso) && empty($disciplina) && !empty($polo)) {
            $data = Dados::where('codigo_curso', $curso)
                ->where('polo', $polo)->get();

                if ($media == 1) {
                    $data = Dados::where(function ($query) use ($curso, $disciplina, $polo) {
                        $query->where('codigo_curso', $curso)
                        ->where('polo', $polo);
                    })
                    ->where(function ($query) {
                        $query->where('ad1','>=', 5)
                            ->orWhere('ap1','>=', 5)
                            ->orWhere('ad2','>=', 5)
                            ->orWhere('ap2','>=', 5);
                    })->get();
        
                } elseif ($media == 2) {
                    $data = Dados::where(function ($query) use ($curso, $disciplina, $polo) {
                        $query->where('codigo_curso', $curso)
                        ->where('polo', $polo);
                    })
                    ->where(function ($query) {
                        $query->where('ad1','<', 5)
                            ->orWhere('ap1','<', 5)
                            ->orWhere('ad2','<', 5)
                            ->orWhere('ap2','<', 5);
                    })->get();
        
                } elseif ($media == 3) {
                    $data = Dados::where(function ($query) use ($curso, $disciplina, $polo) {
                        $query->where('codigo_curso', $curso)
                        ->where('polo', $polo);
                    })
                    ->where(function ($query) {
                        $query->where('ad1', 5)
                            ->orWhere('ap1', 5)
                            ->orWhere('ad2', 5)
                            ->orWhere('ap2', 5);
                    })->get();
        
                } else {
                    $data = Dados::where('codigo_curso', $curso)
                ->where('polo', $polo)->get();
                }
        
        

        }






        // if ($media == 1) {
        //     $data = Dados::where(function ($query) use ($curso, $disciplina, $polo) {
        //         $query->where('codigo_curso', $curso);
        //     })
        //     ->where(function ($query) {
        //         $query->where('ad1','>=', 5)
        //             ->orWhere('ap1','>=', 5)
        //             ->orWhere('ad2','>=', 5)
        //             ->orWhere('ap2','>=', 5);
        //     })->get();

        // } elseif ($media == 2) {
        //     $data = Dados::where(function ($query) use ($curso, $disciplina, $polo) {
        //         $query->where('codigo_curso', $curso);
        //     })
        //     ->where(function ($query) {
        //         $query->where('ad1','<', 5)
        //             ->orWhere('ap1','<', 5)
        //             ->orWhere('ad2','<', 5)
        //             ->orWhere('ap2','<', 5);
        //     })->get();

        // } elseif ($media == 3) {
        //     $data = Dados::where(function ($query) use ($curso, $disciplina, $polo) {
        //         $query->where('codigo_curso', $curso);
        //     })
        //     ->where(function ($query) {
        //         $query->where('ad1', 5)
        //             ->orWhere('ap1', 5)
        //             ->orWhere('ad2', 5)
        //             ->orWhere('ap2', 5);
        //     })->get();

        // } else {
        //     $data = Dados::where('codigo_curso', $curso)->get();
        // }



       

       
        return view('site.home', ['titulo' => 'Home (teste)'], compact('data'));
    }
}
