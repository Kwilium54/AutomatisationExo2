<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class MyExtension extends AbstractExtension
{
    public function getName(): string
    {
        return 'my-extension';
    }

		public function getFunctions(): array {
			return [
				new TwigFunction('getEnvironmentVariable', [$this, 'getEnvironmentVariable']),
				new TwigFunction('getViteAssets', [$this, 'getViteAssets']),
			];
		}

		public function getEnvironmentVariable(string $varName): ?string {
			return $_ENV[$varName] ?? null;
		}

		public function manifest() {
			$json_file_path = __DIR__ . '/../../public/build/.vite/manifest.json';
			if (file_exists($json_file_path)) {
				$json_data = file_get_contents($json_file_path);

				return json_decode($json_data, true);
			}

			return '';
		}

		public function getViteAssets(): string {
			if ($_ENV['ENV'] === 'prod') {
				$manifest = $this->manifest();
				if (!$manifest) {
					return '';
				}

				return 'xxxxx'; 	// todo : return hashed filenames (css and js) in production, use manifest.json content to dynamise
			}
			else {
				return 'yyyyyy'; // todo : return dev server (app.js and vite client) in development
			}
		}
}
