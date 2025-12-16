<x-app-layout>
    <x-slot name="title">Dashboard</x-slot>

    <div class="h-screen-content overflow-auto">
        <!-- Breadcrumb -->
        <x-ui-breadcrumb :breadcrumbs="['Dashboard' => route('dashboard'), 'Role' => '']"/>

        <!-- Content -->
        <div class="px-3">
            <div class="flex flex-row gap-5">
                <!-- Data -->
                <div class="w-8/12">
                    <div class="card">
                        <div class="card-header">
                            <h2>Roles information</h2>
                            <div class="card-setting">
                                <x-ui.search :action="route('role.create')" />
                            </div>
                        </div>
                        <div class="card-body">
                            @if (count($items) > 0)
                                <div class="table-container overflow-x-auto">
                                    <table>
                                        <tr>
                                            <th class="w-[5%]">#</th>
                                            <th class="w-[30%]">Name</th>
                                            <th class="w-[55%]">Permission</th>
                                            <th class="w-[10%]">Action</th>
                                        </tr>
                                        @foreach ($items as $key => $item)
                                            <tr>
                                                <th>{{ ++$key }}</th>
                                                <td>{{ $item->name }}</td>
                                                <td class="text-xs text-wrap">
                                                    {{ $item->permissions->pluck('name')->implode(', ') }}</td>
                                                <td class="w-[15%]">
                                                    <x-table-button-group :url="['update' => '?uid='.encrypt($item->id), 'delete' => route('role.destroy', [encrypt($item->id)])]" />
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            @else
                                <x-not-found/>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- Form -->
                <div class="w-4/12">
                    <div class="card">
                        <div class="card-header">
                            <h2>Permission {{ $update ? 'Update' : 'Insert' }}</h2>
                        </div>
                        <div class="card-body">
                            <x-form-base
                                action="{{ $update ? route('role.update') : route('role.store') }}"
                                method="post" :update="$update ?? ''">
                                @csrf
                                <x-form-input label="Name" id="name" name="name"
                                    placeholder="Enter your name" value="{{ $update->name ?? '' }}" />
                                <div class="form-group">
                                    <label>Permissions</label>
                                    <div class="flex flex-row justify-center items-center py-2">
                                        <label class="custom-checkbox">
                                            <input type="checkbox" id="all_check">
                                            <label for="all_check">Check all permissions</label>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="grid grid-cols-2 gap-2">
                                        @if ($permissions->isNotEmpty())
                                            @foreach ($permissions as $permission)
                                                <label class="custom-checkbox">
                                                    <input type="checkbox" id="permission_{{ $permission->id }}"
                                                        name="permission[]" value="{{ $permission->name }}"
                                                        {{ empty($update) ? null : (in_array($permission->name, $updatePermissions) ? 'checked' : null) }}>
                                                    <label
                                                        for="permission_{{ $permission->id }}">{{ $permission->name }}</label>
                                                </label>
                                            @endforeach

                                        @endif
                                    </div>
                                </div>
                                <div class="mt-10">
                                    <x-form-ButtonGroup url="role.create" :update="$update" />
                                </div>
                            </x-form-base>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-slot name="js">
        <script>
            const allCheck = document.getElementById('all_check');
            const checkboxes = document.querySelectorAll('input[type="checkbox"]');
            allCheck.addEventListener('change', function() {
                checkboxes.forEach((checkbox) => {
                    checkbox.checked = allCheck.checked;
                });
            });
        </script>
    </x-slot>
</x-admin>
