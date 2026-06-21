# TODO - Email Verification & Password Reset

- [x] Modifier VerifyEmailController pour rediriger vers la page de login (et gérer email déjà vérifié)

- [ ] Modifier VerifyEmailController pour gérer lien expiré (redir vers login + message)
- [ ] Modifier EmailVerificationPromptController si nécessaire pour cohérence
- [ ] Modifier PasswordResetLinkController pour messages exacts FR :
    - [ ] "Adresse email incorrecte"
    - [ ] "Ce compte n'existe pas"

- [ ] (Optionnel) Modifier NewPasswordController pour cohérence des erreurs
- [ ] Ajouter traductions FR exactes si nécessaire (ou patcher directement les contrôleurs)
- [ ] Vérifier que les routes et vues correspondent aux noms attendus
- [ ] Lancer des tests manuels / commande artisan pour valider
