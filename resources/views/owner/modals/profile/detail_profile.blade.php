<div class="modal fade" id="detailProfile{{ $user->id }}" tabindex="-1" aria-labelledby="detailProfile Label"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="detailProfile Label">Modal Detail Profile</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-fill nav-tabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="fill-tab-0" data-bs-toggle="tab" href="#data-owner"
                            role="tab" aria-controls="data-owner" aria-selected="true"> Data Owner </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="fill-tab-1" data-bs-toggle="tab" href="#data-restaurant" role="tab"
                            aria-controls="data-restaurant" aria-selected="false"> Data Restaurant </a>
                    </li>
                </ul>
                <div class="tab-content pt-5" id="tab-content">
                    <div class="tab-pane active" id="data-owner" role="tabpanel" aria-labelledby="fill-tab-0">
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <th scope="row">First Name</th>
                                    <td>{{ $user->first_name ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Last Name</th>
                                    <td>{{ $user->last_name ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Username</th>
                                    <td>{{ $user->name ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Email</th>
                                    <td>{{ $user->email ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Role</th>
                                    <td>{{ $user->role }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="data-restaurant" role="tabpanel" aria-labelledby="fill-tab-1">
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <th scope="row">Name Restaurant</th>
                                    <td>{{ $restaurant->name_restaurant ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Address</th>
                                    <td>{{ $restaurant->address ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Status</th>
                                    <td>{{ $restaurant->status ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Verified at</th>
                                    <td>{{ $restaurant->verified_at ? \Carbon\Carbon::parse($restaurant->verified_at)->format('d-m-Y H:i:s') : '-' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
