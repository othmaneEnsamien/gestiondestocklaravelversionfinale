@component('mail::message')
    # Bienvenue sur notre site !

    Bonjour {{ $user->name }},

    Vous êtes maintenant enregistré sur notre site. Voici vos informations de connexion :

    Nom d'utilisateur : {{ $user->name }}
    Adresse e-mail : {{ $user->email }}
    Mot de passe : {{ $user->password }}

    Merci d'avoir rejoint notre site !

    Cordialement,
    L'équipe de yancom creation
@endcomponent
