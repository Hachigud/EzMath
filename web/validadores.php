
<script>
function validarEmail() {
            var x = document.getElementById("Correo").value;
            var expreg = new RegExp("^[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)$");
            //console.log(expreg.test(x))
            if (expreg.test(x)) {

            } else {
                Swal.fire("CUIDADO!", "El fomato del correo es incorrecto", "error")
                document.getElementById("Correo").value = "";

            }
        }
        function validarNombreUsuario() {
            var x = document.getElementById("Nombre").value;
            var expreg = new RegExp("^[a-zA-Z]+[ ]*[a-zA-Z]{3,16}$");
            //console.log(expreg.test(x))
            if (expreg.test(x)) {

            } else {
                Swal.fire("CUIDADO!", "El fomato  del Nombre es incorrecto", "error")
                document.getElementById("Nombre").value = "";

            }
        }
        function validarapellidoPaternoUsuario() {
            var x = document.getElementById("ApellidoPaterno").value;
            var expreg = new RegExp("^[a-zA-Z]{4,16}$");
            //console.log(expreg.test(x))
            if (expreg.test(x)) {

            } else {
                Swal.fire("CUIDADO!", "El fomato  del Apellido paterno es incorrecto", "error")
                document.getElementById("ApellidoPaterno").value = "";

            }
        }
        function validarapellidoMaternoUsuario() {
            var x = document.getElementById("ApellidoMaterno").value;
            var expreg = new RegExp("^[a-zA-Z]{4,16}$");
            //console.log(expreg.test(x))
            if (expreg.test(x)) {

            } else {
                Swal.fire("CUIDADO!", "El fomato  del Apellido Materno es incorrecto", "error")
                document.getElementById("ApellidoMaterno").value = "";

            }
        }

        function validarContraseña(){
            var x = document.getElementById("Contraseña").value;
            var expreg = new RegExp("^[a-zA-Z0-9]{8,16}$");
            //console.log(expreg.test(x))
            if (expreg.test(x)) {

            } else {
                Swal.fire("CUIDADO!", "El fomato  de la contraseña es incorrecto", "error")
                document.getElementById("Contraseña").value = "";

            }
        }


        function validarEdad(){
            var x = document.getElementById("Edad").value;
            var expreg = new RegExp("^[1-9][0-9]*$");
            if (expreg.test(x)) {

            } else {
            wal.fire("CUIDADO!", "El fomato  de la edad es incorrecto", "error")
                ocument.getElementById("Edad").value = "";

    }
        }




        
        </script>