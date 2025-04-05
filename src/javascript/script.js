$(document).ready(function(){


    //função para mostrar o editor de tarefas
    $('.edit-button').on('click', function(){

        // Encontrando o elemento pai mais próximo com a classe 'task'
        var $task = $(this).closest('.task'); 
        
        // Adicionando a classe 'hidden' aos elementos
        $task.find('.progress').addClass('hidden'); 
        $task.find('.task-description').addClass('hidden'); 
        $task.find('.task-actions').addClass('hidden');
        $task.find('.task-date').addClass('hidden');
        $task.find('.task-status').addClass('hidden');

        // Removendo a classe 'hidden' do editor de tarefas
        $task.find('.edit-task').removeClass('hidden');
        
    })

    //função para adicionar a class done (tarefa concluída visualmente)
    $('.progress').on('click', function(){

        if($(this).is(':checked')){
           $(this).addClass('done');
        }else{
            $(this).removeClass('done'); 
        }

    });



    $('.progress').on('change', function() {
        const $checkbox = $(this); // Armazena a referência correta
        const id = $checkbox.data('task-id'); // Obtém o ID da tarefa do atributo data-task-id
        const completed = $checkbox.is(':checked') ? 1 : 0; 

        // Envia a requisição AJAX para atualizar o progresso da tarefa
        $.ajax({
            url: 'https://to-dolist-production-0697.up.railway.app/actions/update-progress.php',
            method: 'POST',
            data: {
                id: id,
                completed: completed
            },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    console.log('Tarefa atualizada com sucesso.');

                   // Atualiza o status visualmente
                   let $status = $checkbox.closest('.task').find('.task-status');
                   $status.text(completed ? 'Concluída' : 'Em andamento');
                } else {
                    console.error('Erro ao atualizar a tarefa:', response.message || 'Sem mensagem do servidor.');
                }
            },
            error: function(xhr, status, error) {
                console.error('Erro na requisição AJAX:', error);
            }
        });
    });

    // função para filtrar as tarefas por status 
    $('#filter-status').on('change', function () {
        const selectedStatus = $(this).val();
    
        
        $('.task').each(function () {
            const taskStatus = $(this).data('status').toString();
            
            // Verifica se o status da tarefa corresponde ao status selecionado
            if (selectedStatus === '' || taskStatus === selectedStatus) {
                $(this).removeClass('hidden');
            } else {
                $(this).addClass('hidden');
            }
        });
    });
    
    // função para filtrar as tarefas por data
    $('#filter-date').on('change', function () {
        const order = $(this).val();
        const $tasks = $('.task');
    
    
        const sorted = $tasks.sort(function (a, b) {
            const dateA = new Date($(a).data('date'));
            const dateB = new Date($(b).data('date'));
            
            
            if (order === 'asc') {
                return dateA - dateB;
            } else if (order === 'desc') {
                return dateB - dateA;
            } else {
                return 0;
            }
        });
    
        $('#tasks').html(sorted); // Substitui a lista com as tarefas ordenadas
    });
    



});