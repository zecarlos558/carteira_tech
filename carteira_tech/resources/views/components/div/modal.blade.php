<!-- Modal -->

<div class="modal fade" id={{@$idModal}} tabindex="-1" role="dialog" aria-labelledby={{@$idTitulo}} aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
        <div class="modal-content">
                <div class="modal-header">
                        <h5 class="modal-title">@isset($titulo) {{$titulo}} @endisset</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
            <div class="modal-body">
                <div class="container-fluid">
                    @isset($corpo)
                    {{$corpo}}
                    @endisset
                </div>
            </div>
            <div class="modal-footer">
                @isset($rodape)
                {{$rodape}}
                @endisset
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

