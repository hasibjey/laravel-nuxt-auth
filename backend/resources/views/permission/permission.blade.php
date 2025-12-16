<x-app-layout>
    <x-slot name="title">Dashboard</x-slot>

    <div class="h-screen-content overflow-auto">
        <!-- Breadcrumb -->
        <x-ui-breadcrumb :breadcrumbs="['Dashboard' => route('dashboard'), 'Permission' => '']"/>

        <!-- Content -->
        <div class="px-3">
            <div class="flex flex-row gap-5">
                <!-- Data -->
                <div class="w-8/12">
                    <div class="card">
                        <div class="card-header">
                            <h2>Permissions information</h2>
                            <div class="card-setting">
                                <x-ui-search/>
                            </div>
                        </div>
                        <div class="card-body">
                            @if (count($items) > 0)
                                <div class="table-container overflow-x-auto">
                                    <table>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Action</th>
                                        </tr>
                                        @foreach ($items as $key => $item)
                                            <tr>
                                                <th>{{ ++$key }}</th>
                                                <td>{{ $item->name }}</td>
                                                <td class="w-[15%]">
                                                    <x-table-button-group :url="['update' => '?uid='.encrypt($item->id), 'delete' => route('permission.destroy', [encrypt($item->id)])]"/>
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
                                action="{{ $update ? route('permission.update') : route('permission.store') }}"
                                method="post"
                                :updateData="$update ?? ''">
                                <x-form-input label="name" id="name" name="name" placeholder="Enter permission name" :value="$update->name ?? old('name')"/>
                                <div class="mt-10">
                                    <x-form-ButtonGroup url="permission.create" :update="$update" />
                                </div>
                            </x-form-base>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
