<?php
/**
*
* @package phpBB3
* @copyright (c) 2006 phpBB Group
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
* This file creates new schema files for every database.
* The filenames will be prefixed with an underscore to not overwrite the current schema files.
*
* If you overwrite the original schema files please make sure you save the file with UNIX linefeeds.
*/

$root_path = dirname(__FILE__) . '/../';

$spellings = json_decode(file_get_contents($root_path . 'develop/misspellings.json'), true);
$spellings_de = json_decode(file_get_contents($root_path . 'develop/misspellings_de.json'), true);
$output = '';

// Cycle through all files
$iterator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($root_path, \FilesystemIterator::SKIP_DOTS | \FilesystemIterator::UNIX_PATHS), \RecursiveIteratorIterator::SELF_FIRST);
foreach ($iterator as $file_info)
{
	$file_path = $file_info->getPath();
	$file = $file_info->getFilename();
	if ($file === 'spellchecker.php')
	{
		continue;
	}

	if (file_exists($file_path . '/' . $file) && preg_match('/.+\.(?:(php))$/', $file))
	{
		$content = file_get_contents($file_path . '/' . $file);
		if (!empty($content))
		{
			// English files and php files
			if (!preg_match('/(?:(\/language\/de))/', $file_path))
			{
				$found_misspellings = array();
				foreach ($spellings as $misspell => $correct)
				{
					if (preg_match('/\b(?:(' . $misspell . '))\b/', $content) != false)
					{
						//$output .= "Found misspelling \"$misspell\" in $file<br />Should probably be: $correct<br /><br />";
						$found_misspellings[$misspell] = $correct;
					}
				}

				if (!empty($found_misspellings))
				{
					$lines = file($file_path . '/' . $file);

					foreach ($spellings as $misspell => $correct)
					{
						if (!isset($found_misspellings[$misspell]))
						{
							$continue;
						}

						foreach ($lines as $line_no => $line)
						{
							if (preg_match('/\b(?:(' . $misspell . '))\b/', $line) != false)
							{
								$output .= "Found misspelling \"$misspell\" in " . realpath($file_path) . "/$file at Line $line_no<br />Should probably be: $correct<br /><br />";
							}
						}
					}
				}
			}
			else
			{
				$found_misspellings = array();
				foreach ($spellings_de as $misspell => $correct)
				{
					if (preg_match('/\b(?:(' . $misspell . '))\b/', $content) != false)
					{
						//$output .= "Found misspelling \"$misspell\" in $file<br />Should probably be: $correct<br /><br />";
						$found_misspellings[$misspell] = $correct;
					}
				}

				if (!empty($found_misspellings))
				{
					$lines = file($file_path . '/' . $file);

					foreach ($spellings_de as $misspell => $correct)
					{
						if (!isset($found_misspellings[$misspell]))
						{
							$continue;
						}

						foreach ($lines as $line_no => $line)
						{
							if (preg_match('/\b(?:(' . $misspell . '))\b/', $line) != false)
							{
								$output .= "Found misspelling \"$misspell\" in " . realpath($file_path) . "/$file at Line $line_no<br />Should probably be: $correct<br /><br />";
							}
						}
					}
				}
			}
		}
	}
}

if (PHP_SAPI == 'cli')
{
	$output = str_replace('<br />', "\n", $output);
}

echo $output;

// Exit with 1 if script encountered issues
if (strlen($output) > 0)
{
	exit(1);
}
