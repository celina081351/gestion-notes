# Déploiement frontend sur Vercel

Ce dépôt contient une application Laravel. Pour déployer uniquement les assets frontend sur Vercel (sans le backend PHP), suis ces instructions.

1. Dans le tableau de bord Vercel, clique sur **New Project** → **Import Git Repository** et choisis `celina081351/gestion-notes`.
2. Lors de la configuration du projet sur Vercel, vérifie ces paramètres :
   - **Framework Preset** : Other (ou laisse la détection automatique)
   - **Build Command** : `npm run build`
   - **Output Directory** : `public/build`
3. `vercel.json` est déjà ajouté pour indiquer à Vercel d'utiliser `@vercel/static-build` et de servir `public/build`.
4. Variables d'environnement (optionnel) :
   - `VITE_APP_NAME=Gestion Notes`

Notes :
- Le backend Laravel (PHP) ne sera pas exécuté sur Vercel ; seules les ressources statiques générées par Vite seront servies.
- Pour un déploiement complet (backend + base de données), utilise une plateforme supportant PHP (Render, Railway, DigitalOcean, etc.).

Après import, Vercel lancera automatiquement un build à chaque push sur la branche `main`.
