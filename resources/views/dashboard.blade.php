<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar veículos</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </x-slot>

        <!-- Card explicando o projeto -->
        <div class="flex justify-center items-center mt-6">
            <div class="bg-white p-6 rounded-lg shadow-lg max-w-xl text-center">
                <h3 class="text-2xl font-semibold text-gray-900">Projeto Concessionária</h3>
                <p class="mt-4 text-gray-700">Este projeto descreve os veículos disponíveis em uma concessionária,
                    permitindo a visualização, edição e exclusão de informações de veículos, além de possibilitar o
                    cadastro de novos modelos.</p>
                <p class="mt-4 text-gray-700">Para começar, cadastre um veículo.</p>
                <div class="flex justify-center items-center mt-10">
                    <button onclick="toggleForm()"
                        class="px-6 py-3 bg-green-500 text-white text-lg font-medium rounded-lg hover:bg-green-700 focus:outline-none">
                        Cadastrar Veículo
                    </button>
                </div>
            </div>
        </div>

        <!-- Formulário de Cadastro de Veículo (inicialmente oculto) -->
        <div id="vehicleForm" class="flex justify-center items-center mt-6 hidden">
            <form class="bg-white p-6 rounded-lg shadow-lg w-full sm:w-4/6 space-y-4" method="POST"
                action="/createcarro" enctype="multipart/form-data">
                @csrf
                <input type="text" name="Modelo" class="w-full border border-gray-300 rounded-lg p-3"
                    placeholder="Modelo do Veículo">
                <input type="text" name="Marca" class="w-full border border-gray-300 rounded-lg p-3"
                    placeholder="Marca">
                <input type="text" name="Ano" class="w-full border border-gray-300 rounded-lg p-3" placeholder="Ano">
                <input type="text" name="Cambio" class="w-full border border-gray-300 rounded-lg p-3"
                    placeholder="Câmbio">
                <input type="text" name="ArCondicionado" class="w-full border border-gray-300 rounded-lg p-3"
                    placeholder="Ar-condicionado">
                <input type="text" name="Cor" class="w-full border border-gray-300 rounded-lg p-3" placeholder="Cor">
                <input type="text" name="Combustivel" class="w-full border border-gray-300 rounded-lg p-3"
                    placeholder="Combustível">
                <input type="text" name="Placa" class="w-full border border-gray-300 rounded-lg p-3"
                    placeholder="Placa">
                <input type="file" name="FotoCarro" class="w-full border border-gray-300 rounded-lg p-3"
                    placeholder="Foto do Carro">
                <button type="submit"
                    class="w-full py-3 bg-green-500 text-white text-lg font-medium rounded-lg hover:bg-green-700 focus:outline-none">
                    Cadastrar
                </button>
            </form>
        </div>

        <!-- Exibição dos veículos -->
        <div class="w-full min-h-screen flex flex-wrap justify-center items-center mt-6">
            @foreach ($carros as $carro)
                <div
                    class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700 m-4">
                    @if ($carro->Foto)
                        <img src="{{ asset('storage/' . $carro->Foto) }}"
                            class="w-full h-full rounded-tl-lg rounded-tr-lg md:w-48 md:rounded-none md:rounded-s-lg">
                    @else
                        <img class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-s-lg"
                            src="https://cdn.autopapo.com.br/box/uploads/2024/08/17113610/lincoln-town-car-1993-branco-frente-lateral-silvio-santos-732x488.jpg"
                            alt="Carro padrão">
                    @endif

                    <div class="flex flex-col justify-between p-4 leading-normal">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                            {{ $carro->modelo }} - {{ $carro->marca }}
                        </h5>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                            Ano: {{ $carro->ano }}<br>
                            Câmbio: {{ $carro->cambio }}<br>
                            Ar-condicionado: {{ $carro->ar_condicionado }}<br>
                            Cor: {{ $carro->cor }}<br>
                            Combustível: {{ $carro->combustivel }}<br>
                            Placa: {{ $carro->placa }}
                        </p>

                        <!-- Botões de Editar e Excluir -->
                        <div class="flex space-x-2 mt-4">
                            <button
                                class="px-4 py-2 bg-blue-500 text-white text-sm font-medium rounded-lg hover:bg-blue-700 focus:outline-none">Editar</button>
                                <a href="/excluir/{{ $carro->id}}" > <button
                                class="px-4 py-2 bg-red-500 text-white text-sm font-medium rounded-lg hover:bg-red-700 focus:outline-none">Excluir</button>
                                </a>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>

    </x-app-layout>

    <script>
        function toggleForm() {
            const form = document.getElementById('vehicleForm');
            form.classList.toggle('hidden');
        }
    </script>
</body>

</html>