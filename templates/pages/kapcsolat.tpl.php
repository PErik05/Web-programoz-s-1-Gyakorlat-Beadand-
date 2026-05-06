<h2>Kapcsolat</h2>

<form method="post" action="index.php?kapcsolat_kuld" onsubmit="return validateForm()">

    Név:<br>
    <input type="text" name="name" id="name"><br><br>

    Email:<br>
    <input type="text" name="email" id="email"><br><br>

    Üzenet:<br>
    <textarea name="message" id="message"></textarea><br><br>

    <button type="submit">Küldés</button>

</form>

<script>
function validateForm() {
    let name = document.getElementById("name").value.trim();
    let email = document.getElementById("email").value.trim();
    let message = document.getElementById("message").value.trim();

    if (name === "" || email === "" || message === "") {
        alert("Minden mező kitöltése kötelező!");
        return false;
    }

    let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(email)) {
        alert("Hibás email cím!");
        return false;
    }

    return true;
}
</script>