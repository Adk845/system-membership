<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class=" w-full bg-white p-8 rounded-lg shadow-md">
        <h2 class="text-center flex text-2xl font-bold text-gray-900 mb-6">Register</h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="flex flex-wrap">
                <!-- Name -->
                <div class="mb-4 w-1/2 p-2">
                    <label for="name" class="block text-sm font-medium text-gray-700">Username</label>
                    <input id="name" name="name" type="text" required autofocus
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                        value="{{ old('name') }}">
                    @error('name')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-4 w-1/2 p-2">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input id="email" name="email" type="email" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                        value="{{ old('email') }}">
                    @error('email')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-4 w-1/2 p-2">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input id="password" name="password" type="password" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    @error('password')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="mb-4 w-1/2 p-2">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <!-- Nama Anggota -->
                <div class="mb-4 w-1/2 p-2">
                    <label for="nama_anggota" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                    <input id="nama_anggota" name="nama_anggota" type="text" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                        value="{{ old('nama_anggota') }}">
                    @error('nama_anggota')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Domisili -->
                <div class="mb-6 w-1/2 p-2">
                    <label for="domisili" class="block text-sm font-medium text-gray-700">Domisili</label>
                    <select type="select" id="domisili-select" name="domisili"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        <option name="" id=""></option>
                        @foreach ($domisili as $id => $item)
                            <option name="{{ $item }}" id="" value="{{ $item }}">{{ $item }}</option>
                        @endforeach

                    </select>                    
                </div>

                
                <div class="kotener_peminatan_bioskop flex gap-4">                    
                    <div>
                        <h2 class="text-xl">Peminatan</h2>
                        <div class="flex flex-row">                                        
                            <div class="pe-4 pt-4 pb-4">
                                <label for="nonton">Nonton</label>
                                <input type="checkbox" id="nonton" name="nonton">
                            </div>
                            <div class="pe-4 pt-4 pb-4">
                                <label for="nonton">Seminar</label>
                                <input type="checkbox" name="seminar">
                            </div>
                            <div class="pe-4 pt-4 pb-4">
                                <label for="nonton">Seminar berbayar</label>
                                <input type="checkbox" name="seminar_berbayar">
                            </div>
                        </div>
                    </div>
                    
                    <div id="bioskop-container">
                        <h2 class="text-xl">Bioskop</h2>
                        <select id="bioskop" name="bioskop[]" multiple class="pt-4">
                        
                        </select>
                    </div>
                </div>
                
            </div>

            <div>
                <button type="submit"
                    class="flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    Register
                </button>
            </div>
        </form>
    </div>
</div>
@push('script')

{{-- TAMBAHIN FITUR TOM SELECT BIAR SEARCHABLE DROPDOWN NYA  --}}
<script>

    new TomSelect("#domisili-select", {
        create: false,
        sortField: {
            field: "text",
            direction: "asc"
        }
    });

    new TomSelect("#bioskop", {
        maxItems: 3,
        create: false,
        sortField: {
            field: "text",
            direction: "asc"
        },
        placeholder: 'max 3'
    });

    // DOM change logic
    $('#bioskop-container').hide();
    $(document).ready(function () {
        $('#nonton').on('change', function () {
            if ($(this).is(':checked')) {
                $('#bioskop-container').show();
                console.log('di ceklis cuk');
                
                
            } else {
                $('#bioskop-container').hide();
            }
        });
    });

    $('#domisili-select').on('change', function() {
        let wilayah = $(this).val();
        let bioskopSelect = $('#bioskop')[0].tomselect;

        bioskopSelect.clearOptions();
        bioskopSelect.addOption({ value: '', text: 'Loading...' });
        bioskopSelect.refreshOptions();

        $.get(`/api/bioskop/search/${wilayah}`, function(data) {
            bioskopSelect.clearOptions();

            if (data.length === 0) {
                bioskopSelect.addOption({ value: '', text: 'Tidak ada bioskop' });
            } else {
                data.forEach(function(item) {
                    bioskopSelect.addOption({ value: item.id, text: item.bioskop });
                });
            }

            bioskopSelect.refreshOptions();
        });
    });



</script>

@endpush
</x-guest-layout>
