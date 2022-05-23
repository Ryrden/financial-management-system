<div class="modal fade" id="editTransactionModal" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark">Editar uma movimentação</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?=BASE_URL."/transaction/update"?>" method="post">
                <div class="modal-body d-flex flex-column">
                    <div class="form-group">
                        <label class="text-dark" for="modalNome">Nome</label>
                        <input type="text" class="form-control" id="modalNome" name="nome"
                               placeholder="Nome da movimentação">
                    </div>
                    <div class="form-group">
                        <label class="text-dark" for="modalValor">Valor</label>
                        <input type="number" step="0.01" class="form-control" id="modalValor" name="valor"
                               placeholder="00.00">
                    </div>
                    <div class="form-group">
                        <label class="text-dark" for="modalTipo">Example select</label>
                        <select class="form-control" name="tipo" id="modalTipo">
                            <option value="ganho" selected>Ganho</option>
                            <option value="gasto">Gasto</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="text-dark" for="modalData">Data</label>
                        <input type="date" class="form-control" id="modalData" name="data">
                    </div>
                    <input type="hidden" name="id" value="" id="modalId">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Editar</button>
                </div>
            </form>
        </div>
    </div>
</div>