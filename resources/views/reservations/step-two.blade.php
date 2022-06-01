<x-guest-layout>
    <div class="container w-full px-5 py-6 mx-auto">
        <div class="flex items-center min-h-screen bg-gray-50">
            <div class="flex-1 h-full max-w-4xl mx-auto bg-white rounded-lg shadow-xl">
                <div class="flex flex-col md:flex-row">
                    <div class="h-32 md:h-auto md:w-1/2">
                        <img class="object-cover w-full h-full"
                            src="https://cdn.pixabay.com/photo/2021/01/15/17/01/green-5919790__340.jpg" alt="img" />
                    </div>
                    <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
                        <div class="w-full">
                            <h3 class="mb-4 text-xl font-bold text-blue-600">Make Reservation</h3>

                            <div class="w-full bg-gray-200 rounded-full">
                                <div
                                    class="w-40 p-1 text-xs font-medium leading-none text-center text-blue-100 bg-blue-600 rounded-full">
                                    Step1</div>
                            </div>
                            <form action="" method="POST">
                                @csrf
                                <div class="sm:col-span-6 pt-5">
                                    <label for="res_date" class="block text-sm font-medium text-gray-700"> Reservation Date </label>
                                    <div class="mt-1">
                                        <input type="datetime-local" id="res_date" wire:model.lazy="res_date" name="res_date" value="{{ date('Y-m-d\TH:i:s', strtotime($reservation->res_date)) }}" class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5
                                        @error('res_date')
                                            border-red-500
                                        @enderror
                                        " />
                                        <x-error error="res_date"/>
                                    </div>
                                </div>
                                <div class="sm:col-span-6 pt-5">
                                    <label for="guest_number" class="block text-sm font-medium text-gray-700"> Guest Number </label>
                                    <div class="mt-1">
                                        <input type="number" id="guest_number" wire:model.lazy="guest_number" name="guest_number" value="{{$reservation->guest_number}}" class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5
                                        @error('guest_number')
                                            border-red-500
                                        @enderror
                                        " />
                                        <x-error error="guest_number"/>
                                    </div>
                                </div>
                                <div class="sm:col-span-6 pt-5">
                                    <label for="table_id" class="block text-sm font-medium text-gray-700">Tabel</label>
                                    <div class="mt-1">
                                        <select name="table_id" id="table_id" class="form-multiselect block w-full mt-1
                                        @error('table_id')
                                            border-red-500
                                        @enderror
                                        ">
                                                @foreach ($tables as $table)
                                                    <option value="{{ $table->id }}" @selected($table->id == $reservation->table_id)>{{$table->name}} ({{$table->guest_number}} Guests)</option>
                                                @endforeach
                                        </select>
                                        <x-error error="table_id"/>
                                    </div>
                                </div>
                                <div class="flex justify-end mt-6 p-4">
                                    <button type="submit" class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-guest-layout>