<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @if($errors->any())
    <div class="text-red-500">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
            @endif
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nom complet')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Téléphone -->
        <div class="mt-4">
            <x-input-label for="telephone" :value="__('Téléphone')" />
            <x-text-input id="telephone" name="telephone" type="text" class="block mt-1 w-full"
                :value="old('telephone')" required />
            <x-input-error :messages="$errors->get('telephone')" class="mt-2" />
        </div>

        <!-- Rôle -->
        <div class="mt-4">
            <x-input-label for="role" :value="__('Rôle')" />
            <select name="role" id="role" onchange="toggleFields()"
                class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm">
                <option value="">-- Choisir --</option>
                <option value="medecin" {{ old('role') === 'medecin' ? 'selected' : '' }}>Médecin</option>
                <option value="patient" {{ old('role') === 'patient' ? 'selected' : '' }}>Patient</option>
            </select>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <!-- Spécialité (médecin uniquement) -->
        <div class="mt-4" id="medecin-fields" style="display:none">
            <x-input-label for="specialite" :value="__('Spécialité')" />
            <x-text-input id="specialite" name="specialite" type="text" class="block mt-1 w-full"
                :value="old('specialite')" />
            <x-input-error :messages="$errors->get('specialite')" class="mt-2" />
        </div>

        <!-- Adresse (patient uniquement) -->
        <div class="mt-4" id="patient-fields" style="display:none">
            <x-input-label for="adresse" :value="__('Adresse')" />
            <x-text-input id="adresse" name="adresse" type="text" class="block mt-1 w-full"
                :value="old('adresse')" />
            <x-input-error :messages="$errors->get('adresse')" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Mot de passe')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password"
                name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirmer le mot de passe')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                href="{{ route('login') }}">
                {{ __('Déjà inscrit ?') }}
            </a>
            <x-primary-button class="ms-4">
                {{ __('S\'inscrire') }}
            </x-primary-button>
        </div>
    </form>

    <script>
        function toggleFields() {
            const role = document.getElementById('role').value;
            document.getElementById('medecin-fields').style.display = role === 'medecin' ? 'block' : 'none';
            document.getElementById('patient-fields').style.display = role === 'patient' ? 'block' : 'none';
        }
        window.onload = toggleFields;
    </script>
</x-guest-layout>