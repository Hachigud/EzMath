<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;

 class OperationsTest extends TestCase
{



    private $op;


   // public function setUp():void{
   //     $this->op  = new Usuario();
 //   }
    public function setUp():void{
        $this->op  = new Preguntas();
    }
  
  
    //  public function testValidarContraseña(){
   //       $this->assertEquals(true,$this->op->validarContrasena(35,'incorrecta'));
  //  }

   // public function testValidarUsuario(){
   //     $this->assertEquals(true,$this->op->validarUsuario('usuariousuario','usuario'));
    // }


   //  public function testValidarActualizarEstado(){
  //     $this->assertEquals(true,$this->op->ActualizarEstado(999,5));
  //   }

    public function testValidarSumarFallos(){
        $this->assertEquals(true,$this->op->SumarFallo('id'));
      }

}


?>