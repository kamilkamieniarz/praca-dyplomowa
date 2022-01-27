<script>
    //dodanie i zmiana ikony sortowania + sortowanie
    function filter_icon(state, ws){
        if(state == ws){
            var what_show = $('#'+state).parents('table').attr('id');
            var column = state;
        }
        else{
            var what_show = ws;
            var column=state.slice(0,-5);
        }
        var down = "<th class='blue-clicked' id='"+column+"' onclick=\"filter_icon('"+column+" DESC"+"','"+what_show+"')\">"+column+" <i class='fas fa-caret-up'></i></th>";
        var up = "<th class='blue-clicked-twice' id='"+column+"' onclick=\"filter_icon('"+column+"','"+column+"')\">"+column+" <i class='fas fa-caret-down'></i></th>";
        var clicked = $('#'+column).attr('class');
        $.ajax
        ({   
            type: "POST",
            url:"show.php/?what_show="+what_show+"&filter="+state,
            success:function(result){
                $('#dbody').html(result);
                switch(clicked){
                    case 'blue':
                        $('#'+column).replaceWith(state+' '+down);
                        break;
                    case 'blue-clicked':
                        $('#'+column).replaceWith(state+' '+up);
                        break;
                    case 'blue-clicked-twice':
                        $('#'+column).replaceWith(state+' '+down);
                        break;
                    default:
                        alert('Błąd w ajax.php filter_icon');
                        break;
                }
            }
        });
    }
    //wyświetlanie danych w tabelach
    function show(ws,filter){
        $.ajax
        ({   
            type: "POST",
            url:"show.php/?what_show="+ws+"&filter="+filter,
            success:function(result){$('#dbody').html(result);}
        });
    }
    //usuwanie wpisu
    function del(table,id){
        $.ajax
        ({
            type: "POST",
            url:"del.php/?table="+table+"&id="+id,
            success:function(result){
                alert(result);
                show(table,'id')
            }
        });
    }
    //wyświetlanie formularza do edycji
    function edit(we,id){
        $.ajax
        ({   
            type: "POST",
            url:"edit_form.php/?what_edit="+we+"&id="+id,
            success:function(result){$('#dbody').html(result);}
        });
    }
    //wykonywanie akcji po zatwierdzeniu formularza edycji
    function edition(we,id){
        switch(we){
            //pracownicy
            case 'users':
                var login = $('#login').val();
                var role = $('#role').val();
                var name = $('#name').val();
                var surname = $('#surname').val();
                var city = $('#city').val();
                var postcode = $('#post_code').val();
                var street = $('#street').val();
                var number = $('#number').val();
                var apartment = $('#apartment').val();
                if(login!="" && role!="" && name!="" && surname!="" && city!="" && postcode!="" && street!="" && number!=""){
                    $("#add_worker").attr("disabled", "disabled");
                    $.ajax({
                        url: "edit_update.php/?what_edit=users&id="+id,
                        type: "POST",
                        data: {
                            login: login,
                            role: role,
                            name: name,
                            surname: surname,
                            city: city,
                            post_code: postcode,
                            street: street,
                            number: number,
                            apartment: apartment
                        },
                        cache: false,
                        success: function(data){
                            data = JSON.parse(data);
                            if(data=='0'){
                                $('#add_worker').removeAttr('disabled');
                                $('#form_worker').find('input:text').val('');
                                show('users');		
                                alert('Edytowano pracownika');				
                            }
                            else if(data=='1'){
                            alert("Nie udało się edytować pracownika");
                            }
                            
                        }
                    });
                }
                else{
                    alert('Uzupełnij wszystkie dane');
                }
            break;
        //zadania
        case 'task':
                var name = $('#name').val();
                var description = $('#description').val();
                var category = $('#category').val();
                var creatorid = $('#idd').val();
                var userid = $('#user_id').val();
                var clientid = $('#client_id').val();
                if(name!="" && description!="" && category!="" && creatorid!="" && userid!="" && clientid!=""){
                    $("#add_task").attr("disabled", "disabled");
                    $.ajax({
                        url: "edit_update.php/?what_edit=tasks&id="+id,
                        type: "POST",
                        data: {
                            name: name,
                            description: description,
                            category: category,
                            creator_id: creatorid,
                            user_id: userid,
                            client_id: clientid
                        },
                        cache: false,
                        success: function(data){
                            data = JSON.parse(data);
                            if(data=='0'){
                                $('#add_task').removeAttr('disabled');
                                $('#form_task').find('input:text').val('');
                                show('tasks');		
                                alert('Edytowano zadanie');				
                            }
                            else if(data=='1'){
                            alert("Nie udało się edytować zadania");
                            }
                            
                        }
                    });
                }
                else{
                    alert('Uzupełnij wszystkie dane');
                }
            break;
        //klienci
        case 'client':
                var name = $('#name').val();
                var surname = $('#surname').val();
                var company = $('#company').val();
                var nip = $('#nip').val();
                var description = $('#description').val();
                var city = $('#city').val();
                var postcode = $('#post_code').val();
                var street = $('#street').val();
                var number = $('#number').val();
                var apartment = $('#apartment').val();
                var category = $('#category').val();
                var creatorid = $('#idd').val();
                if(name!="" && surname!="" && company!="" && nip!="" &&  description!="" && city!="" && postcode!="" && street!="" && number!="" && category!="" && creatorid!=""){
                    $("#add_client").attr("disabled", "disabled");
                    $.ajax({
                        url: "edit_update.php/?what_edit=clients&id="+id,
                        type: "POST",
                        data: {
                            name: name,
                            surname: surname,
                            company: company,
                            nip: nip,
                            description: description,
                            city: city,
                            post_code: postcode,
                            street: street,
                            number: number,
                            apartment: apartment,
                            category: category,
                            creator_id: creatorid
                        },
                        cache: false,
                        success: function(data){
                            data = JSON.parse(data);
                            if(data=='0'){
                                $('#add_client').removeAttr('disabled');
                                $('#form_client').find('input:text').val('');
                                show('clients');
                                alert('Edytowano klienta');				
                            }
                            else if(data=='1'){
                            alert("Nie udało się edytować klienta");
                            }
                            
                        }
                    });
                }
                else{
                    alert('Uzupełnij wszystkie dane');
                }
            break;
        //usługi
        case 'service':
                var company = $('#company').val();
                var service = $('#service').val();
                var nip = $('#nip').val();
                var description = $('#description').val();
                var city = $('#city').val();
                var postcode = $('#post_code').val();
                var street = $('#street').val();
                var number = $('#number').val();
                var apartment = $('#apartment').val();
                var creatorid = $('#idd').val();
                if(company!="" && service!="" && nip!="" &&  description!="" && city!="" && postcode!="" && street!="" && number!="" && creatorid!=""){
                    $("#add_service").attr("disabled", "disabled");
                    $.ajax({
                        url: "edit_update.php/?what_edit=services&id="+id,
                        type: "POST",
                        data: {
                            company: company,
                            service: service,
                            nip: nip,
                            description: description,
                            city: city,
                            post_code: postcode,
                            street: street,
                            number: number,
                            apartment: apartment,
                            creator_id: creatorid
                        },
                        cache: false,
                        success: function(data){
                            data = JSON.parse(data);
                            if(data=='0'){
                                $('#add_service').removeAttr('disabled');
                                $('#form_service').find('input:text').val('');
                                show('services');		
                                alert('Edytowano usługę');				
                            }
                            else if(data=='1'){
                            alert("Nie udało się edytować usługi");
                            }
                            
                        }
                    });
                }
                else{
                    alert('Uzupełnij wszystkie dane');
                }
            break;
        case 'images':
                var title = $('#title').val();
                var description = $('#description').val();
                var alt = $('#alt').val();
                var adress = $('#adress').val();
                if(title!="" && description!="" && alt!="" &&  adress!=""){
                    $("#add_images").attr("disabled", "disabled");
                    $.ajax({
                        url: "edit_update.php/?what_edit=images&id="+id,
                        type: "POST",
                        data: {
                            title: title,
                            description: description,
                            alt: alt,
                            adress: adress
                        },
                        cache: false,
                        success: function(data){
                            data = JSON.parse(data);
                            if(data=='0'){
                                $('#add_images').removeAttr('disabled');
                                $('#form_images').find('input:text').val('');
                                show('images');		
                                alert('Edytowano grafikę');				
                            }
                            else if(data=='1'){
                            alert("Nie udało się edytować grafiki");
                            }
                            
                        }
                    });
                }
                else{
                    alert('Uzupełnij wszystkie dane');
                }

            break;
        default:
            alert("Błąd w ajax.php na switchu od edycji");
            break;
        }
        
    }
    //wyświetlanie formularzy do dodawania
    function add(wa){
        $.ajax
        ({   
            type: "POST",
            url:"add_form.php/?what_add="+wa,
            success:function(result){$('#dbody').html(result);}
        });
    }
    //wykonywanie akcji po zatwierdzeniu formularza dodawania
    function insert(wi){
        switch(wi){
            //pracownicy
            case 'users':
                var login = $('#login').val();
                var password = $('#password').val();
                var role = $('#role').val();
                var name = $('#name').val();
                var surname = $('#surname').val();
                var city = $('#city').val();
                var postcode = $('#post_code').val();
                var street = $('#street').val();
                var number = $('#number').val();
                var apartment = $('#apartment').val();
                if(login!="" && password!="" && role!="" && name!="" && surname!="" && city!="" && postcode!="" && street!="" && number!=""){
                    $("#add_worker").attr("disabled", "disabled");
                    $.ajax({
                        url: "add_insert.php/?what_add=users",
                        type: "POST",
                        data: {
                            login: login,
                            password: password,
                            role: role,
                            name: name,
                            surname: surname,
                            city: city,
                            post_code: postcode,
                            street: street,
                            number: number,
                            apartment: apartment
                        },
                        cache: false,
                        success: function(data){
                            data = JSON.parse(data);
                            if(data=='0'){
                                $('#add_worker').removeAttr('disabled');
                                $('#form_worker').find('input:text').val('');
                                show('users');		
                                alert('Dodano pracownika');				
                            }
                            else if(data=='1'){
                            alert("Nie udało się dodać pracownika");
                            }
                            
                        }
                    });
                }
                else{
                    alert('Uzupełnij wszystkie dane');
                }
            break;
        //zadania
        case 'task':
                var name = $('#name').val();
                var description = $('#description').val();
                var category = $('#category').val();
                var creatorid = $('#idd').val();
                var userid = $('#user_id').val();
                var clientid = $('#client_id').val();
                if(name!="" && description!="" && category!="" && creatorid!="" && userid!="" && clientid!=""){
                    $("#add_task").attr("disabled", "disabled");
                    $.ajax({
                        url: "add_insert.php/?what_add=task",
                        type: "POST",
                        data: {
                            name: name,
                            description: description,
                            category: category,
                            creator_id: creatorid,
                            user_id: userid,
                            client_id: clientid
                        },
                        cache: false,
                        success: function(data){
                            data = JSON.parse(data);
                            if(data=='0'){
                                $('#add_task').removeAttr('disabled');
                                $('#form_task').find('input:text').val('');
                                show('tasks');		
                                alert('Przydzielono zadanie');				
                            }
                            else if(data=='1'){
                            alert("Nie udało się przydzielić zadania");
                            }
                            
                        }
                    });
                }
                else{
                    alert('Uzupełnij wszystkie dane');
                }
            break;
        //klienci
        case 'client':
                var name = $('#name').val();
                var surname = $('#surname').val();
                var company = $('#company').val();
                var nip = $('#nip').val();
                var description = $('#description').val();
                var city = $('#city').val();
                var postcode = $('#post_code').val();
                var street = $('#street').val();
                var number = $('#number').val();
                var apartment = $('#apartment').val();
                var category = $('#category').val();
                var creatorid = $('#idd').val();
                if(name!="" && surname!="" && company!="" && nip!="" &&  description!="" && city!="" && postcode!="" && street!="" && number!="" && category!="" && creatorid!=""){
                    $("#add_client").attr("disabled", "disabled");
                    $.ajax({
                        url: "add_insert.php/?what_add=client",
                        type: "POST",
                        data: {
                            name: name,
                            surname: surname,
                            company: company,
                            nip: nip,
                            description: description,
                            city: city,
                            post_code: postcode,
                            street: street,
                            number: number,
                            apartment: apartment,
                            category: category,
                            creator_id: creatorid
                        },
                        cache: false,
                        success: function(data){
                            data = JSON.parse(data);
                            if(data=='0'){
                                $('#add_client').removeAttr('disabled');
                                $('#form_client').find('input:text').val('');
                                show('clients');
                                alert('Dodano klienta');				
                            }
                            else if(data=='1'){
                            alert("Nie udało się dodać klienta");
                            }
                            
                        }
                    });
                }
                else{
                    alert('Uzupełnij wszystkie dane');
                }
            break;
        //usługi
        case 'service':
                var company = $('#company').val();
                var service = $('#service').val();
                var nip = $('#nip').val();
                var description = $('#description').val();
                var city = $('#city').val();
                var postcode = $('#post_code').val();
                var street = $('#street').val();
                var number = $('#number').val();
                var apartment = $('#apartment').val();
                var creatorid = $('#idd').val();
                if(company!="" && service!="" && nip!="" &&  description!="" && city!="" && postcode!="" && street!="" && number!="" && creatorid!=""){
                    $("#add_service").attr("disabled", "disabled");
                    $.ajax({
                        url: "add_insert.php/?what_add=service",
                        type: "POST",
                        data: {
                            company: company,
                            service: service,
                            nip: nip,
                            description: description,
                            city: city,
                            post_code: postcode,
                            street: street,
                            number: number,
                            apartment: apartment,
                            creator_id: creatorid
                        },
                        cache: false,
                        success: function(data){
                            data = JSON.parse(data);
                            if(data=='0'){
                                $('#add_service').removeAttr('disabled');
                                $('#form_service').find('input:text').val('');
                                show('services');		
                                alert('Dodano usługę');				
                            }
                            else if(data=='1'){
                            alert("Nie udało się dodać usługi");
                            }
                            
                        }
                    });
                }
                else{
                    alert('Uzupełnij wszystkie dane');
                }
            break;
        //oceny
        case 'rating':
                var rating = $('#rating').val();
                var servicesid = $('#services_id').val();
                var creatorid = $('#idd').val();
                if(rating!="" && servicesid!="" && creatorid!=""){
                    $("#add_rating").attr("disabled", "disabled");
                    $.ajax({
                        url: "add_insert.php/?what_add=rating",
                        type: "POST",
                        data: {
                            rating: rating,
                            services_id: servicesid,
                            creator_id: creatorid
                        },
                        cache: false,
                        success: function(data){
                            data = JSON.parse(data);
                            if(data=='0'){
                                $('#add_rating').removeAttr('disabled');
                                $('#form_rating').find('input:text').val('');
                                show('services');
                                alert('Dodano ocenę');
                            }
                            else if(data=='1'){
                            alert("Nie udało się dodać oceny");
                            }
                            
                        }
                    });
                }
                else{
                    alert('Uzupełnij wszystkie dane');
                }
            break;
        case 'images':
                var title = $('#title').val();
                var description = $('#description').val();
                var alt = $('#alt').val();
                var adress = $('#adress').val();
                var creatorid = $('#idd').val();
                if(title!="" && description!="" && alt!="" &&  adress!="" && creatorid!=""){
                    $("#add_images").attr("disabled", "disabled");
                    $.ajax({
                        url: "add_insert.php/?what_add=images",
                        type: "POST",
                        data: {
                            title: title,
                            description: description,
                            alt: alt,
                            adress: adress,
                            creator_id: creatorid
                        },
                        cache: false,
                        success: function(data){
                            data = JSON.parse(data);
                            if(data=='0'){
                                $('#add_images').removeAttr('disabled');
                                $('#form_images').find('input:text').val('');
                                show('images');		
                                alert('Dodano grafikę');				
                            }
                            else if(data=='1'){
                            alert("Nie udało się dodać grafiki");
                            }
                            
                        }
                    });
                }
                else{
                    alert('Uzupełnij wszystkie dane');
                }
            break;

        default:
            alert("Błąd w ajax.php na switchu od dodawania");
            break;
        }
    }
</script>