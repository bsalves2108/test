<style>
    .containerTodo {
        padding: 20px;
    }
</style>
<div class="containerTodo">
    <div class="row">
        <div class="col-sm-12">
            <h2 class="text text-success">Todo-list:</h2>
            <div id="todolist">

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="input-group">
                <input type="text"
                       class="form-control"
                       placeholder="Adicionar a lista"
                       id="text">
                <div class="input-group-btn">
                    <button class="btn btn-success">
                        <i class="glyphicon glyphicon-plus">
                        </i></button>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->element('Flash/toast'); ?>

<script>

    $(document).ready(() => {
        addItem();
        removeItem();
        loadItems();
    });

    function loadItems() {
        $.ajax({
            url: '/api/todo',
            method: 'GET',
            success: (data) => {
                data.forEach((task) => {
                    addItemList(task.task, task.id);
                });
            }
        })
    }

    function addItem() {
        $('.btn-success').click(() => {
            const elementId = '#text';
            if ($(elementId).val().length !== 0) {
                $.ajax({
                    url: '/api/todo',
                    method: 'POST',
                    data: {
                        task: $('#text').val()
                    },
                    dataType: 'json',
                    success: (data) => {
                        let text = $(elementId).val();
                        addItemList(text, data.id);
                        $(elementId).val("");
                    },
                    error: () => {
                        displayErrorMessage('Houve um erro ao tentar criar sua tarefa', 'Todo-list')
                    }
                });
            } else {
                displayErrorMessage('Digite um valor', 'Todo-list')
            }
        });
    }

    function removeItem() {
        $(document).on('click', '.alert', function () {

            Swal.fire({
                title: 'Deseja realmente concluir esta tarefa ? (ao atualizar ela irá sumir)',
                confirmButtonColor: '#3369dd',
                cancelButtonColor: '#d34333',
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Concluir',
                showCancelButton: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    let id = $(this).data('id');
                    $.ajax({
                        type: "DELETE",
                        url: '/api/todo/' + id,
                        success: () => {
                            if ($(this).css('text-decoration-line') == "none") {
                                $(this).css('text-decoration-line', 'line-through');
                            } else {
                                $(this).css('text-decoration-line', 'none');
                            }
                            displayMessage("Tarefa concluída com sucesso!");
                        }
                    });
                }
            });
        });
    }

    function addItemList(text, id) {
        let div = `
    <div data-id="${id}" class="alert alert-success alert-dismissible fade in">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
        <p>${text}</p>
    </div>`;
        let content = $('#todolist').html();
        $('#todolist').html(div + content);
    }
</script>
