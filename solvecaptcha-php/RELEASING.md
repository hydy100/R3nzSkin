# RELEASING.md

Quick checklist for releasing a new version:

1. **Commit** your changes and push to the main branch:
   ```bash
   git commit -am "Release X.Y.Z"
   git push
   ```
2. **Tag** the release and push the tag:
   ```bash
   git tag vX.Y.Z
   git push origin vX.Y.Z
   ```
3. **Create Release** on GitHub:
   - Go to **Releases** > **Draft a new release** > select `vX.Y.Z` > **Publish release**
4. **Update Packagist**:
   - Open your package page on Packagist > click **Update**
5. **Verify installation**:
   ```bash
   composer require solvercaptcha/solvecaptcha-php:X.Y.Z
   ```

