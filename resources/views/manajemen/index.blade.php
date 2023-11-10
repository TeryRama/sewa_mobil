<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Car Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-2xl font-bold mb-3">List of Available Cars</h1>
                    <br>
                    <a href="{{ route('cars.create') }}"
                        class="inline-flex items-center px-4 py-2 bg-green-600 border  rounded-md font-semibold text-xs text-black uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:ring ring-green-300 disabled:opacity-25 transition ease-in-out duration-150">
                        Tambah Mobil Baru
                    </a>
                    <br>
                    <input type="text" id="searchInput" placeholder="Cari mobil..."
                        class="border border-gray-300 rounded-md p-2">


                    <br>
                    <ul class="divide-y divide-gray-200">

                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        No
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Merek
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Model
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Nomor Plat
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Tarif Sewa Per Hari
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 carList">
                                <!-- Data dari foreach loop -->
                                <!-- Contoh -->
                                @foreach ($cars as $car)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ $loop->index + 1 }}</div>
                                            <!-- Menampilkan nomor otomatis di sini -->
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ $car->brand }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ $car->model }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ $car->license_plate }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Rp.{{ $car->rental_rate }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                            <form class="inline" action="{{ route('cars.destroy', $car->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="delete-button text-red-600 hover:text-red-900">Hapus</button>
                                            </form>

                                        </td>
                                    </tr>
                                @endforeach
                                <!-- Akhir dari foreach loop -->
                            </tbody>
                        </table>

                    </ul>
                </div>
            </div>
        </div>
    </div>
    <script>
        const searchInput = document.getElementById('searchInput');
        const carList = document.querySelector('.carList'); // Menggunakan .carList untuk menargetkan daftar mobil

        searchInput.addEventListener('input', async (event) => {
            const searchTerm = event.target.value;

            try {
                const response = await fetch(`/cars?search=${searchTerm}`, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json'
                    }
                });

                const data = await response.json();
                console.log(data); // Pastikan data yang diharapkan diterima dari server
                updateCarList(data);
            } catch (error) {
                console.error('Terjadi kesalahan saat melakukan pencarian:', error);
            }
        });

        function updateCarList(data) {
            carList.innerHTML = '';

            data.forEach(car => {
                const row = document.createElement('tr'); // Membuat elemen baris untuk setiap mobil
                const columns = `
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">${car.id}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">${car.brand}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">${car.model}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">${car.license_plate}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                            Rp.${car.rental_rate}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                        <form class="inline" action="{{ route('cars.destroy', $car->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-button text-red-600 hover:text-red-900">Hapus</button>
                        </form>
                    </td>
                `;
                row.innerHTML = columns;
                carList.appendChild(row);
            });
        }

        document.querySelectorAll('.delete-button').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault(); // Mencegah form dari submit otomatis
                const form = this.parentElement; // Mendapatkan form yang terkait dengan tombol yang diklik

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit(); // Submit form jika pengguna mengkonfirmasi
                    }
                });
            });
        });
    </script>
</x-app-layout>
