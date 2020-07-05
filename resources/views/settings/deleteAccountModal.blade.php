<div class="modal fade" id="delete-account-modal" tabindex="-1" role="dialog" aria-labelledby="deleteAccountModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Wollen Sie Ihren Account wirklich löschen?<br>
                Diese Aktion kann nicht rückgängig gemacht werden!
            </div>
            <div class="modal-footer">
                <button type="button" class="btn cancel-btn" data-dismiss="modal">Abbrechen</button>
                <form action="{{route('settings.destroy', $user->id)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn delete-acc-btn" onclick="">Löschen</button>
                </form>
            </div>
        </div>
    </div>
</div>
