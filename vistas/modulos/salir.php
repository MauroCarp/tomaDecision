<?php

session_destroy();

echo '<script>	

document.cookie = "campania=; Path=/sanidadAnimal; Expires=Thu, 01 Jan 1970 00:00:01 GMT;"

document.cookie = "rememberme=; Path=/sanidadAnimal; Expires=Thu, 01 Jan 1970 00:00:01 GMT;"

window.location = "ingreso"

</script>';

?>