window.onload = () => {
    $('#register-button').click(function(){
        let firstName, lastName, email, password, confPassword;
        firstName =$('#firstName');
        lastName = $('#lastName');
        email = $('#email');
        password = $('#password');
        confPassword = $('#confirm-password');

        //regularni izrazi, provera
        //to do- errorCount ne radi dobro, dodati za email proveru da li vec postoji email u bazi
        var errorCount = 0;
        var regexForName = /^[A-ZŠĐŽĆČ][a-zšđžćč]{2,15}(\s[A-ZŠĐŽĆČ][a-zšđžćč]{2,15})?$/;
        var regexForEmail = /^[a-z]((\.|-|_)?[a-z0-9]){2,}@[a-z]((\.|-|_)?[a-z0-9]+){2,}\.[a-z]{2,6}$/i;
        var regexForPassword = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8,}$/;
        check(firstName, regexForName, "Ime nije u dobrom formatu.",'#firstNameMessage');
        check(lastName, regexForName, "Prezime nije u dobrom formatu.", '#lastNameMessage');
        check(email, regexForEmail, "Email nije u dobrom formatu.", '#emailMessage');
        check(password, regexForPassword, "Lozinka mora imati bar jedno malo slova i bar jedno veliko slovo", '#passwordMessage');
        function check(variable, regex, message, labelId){
            let value = variable.val();
            console.log(regex.test(value))
            if(value == ''){
                variable.addClass('error');
                errorCount++;
            }
            else if(!regex.test(value)){
                $(labelId).html(message);
                errorCount++;
            }
            else{
                variable.removeClass('error');
                $(labelId).html('');
                errorCount--;
            }
        }
        if (password.val() != confPassword.val()){
            $('#confPasswordMessage').html('Lozinke se ne podudaraju.');
            errorCount++;
        }
        else{
            $('#confPasswordMessage').html('');
            errorCount--;
        }
        errorCount = 0
        if(errorCount == 0){
            var data = {
                firstName: $('#firstName').val(),
                lastName: $('#lastName').val(),
                email: $('#email').val(),
                password: $('#password').val()
            }
            console.log(data)
        }
        ajaxCallBack('models/register.php', 'post', data, function(result){
            $('#odgovor').html(`<p>${result.Poruka}</p>`);
            console.log(result);
        })

    })
    $("#login-form").submit(function(e){
        let email, password;
        email = $('#logEmail');
        password = $('#logPassword');
        //regularni izrazi
        console.log(123)
        //e.preventDefault();

        //ukoliko ne prolazi proveru regexa e.preventDefault();

        // var errorCount = 0;
        // if(errorCount == 0){
        //     let data = {
        //         email: email.val(),
        //         password :password.val()
        //     }
        //     ajaxCallBack('models/login.php', 'post', data, function(result){
        //         $('#odgovor').html(`<p>${result.Poruka}</p>`);
        //         console.log(result);
        //     })
        // }

    })




}
function ajaxCallBack(url, method, data, result){
    $.ajax({
        url: url,
        method: method,
        data:data,
        dataType: "json",
        success: result,
        error: function(xhr){
            console.log(xhr);
        //    if 500
        //    if404
        }
    })
}