<?php

namespace App\Helpers;

use Illuminate\Http\Request;

class RestHelpers
{
	/**
	 * Recherche dans un objet <request>, les parametres 'range, filtre, desc, sort, fields'.
	 *
	 * @param Request $request
	 *     Ojet Request à analyser
	 * @param Array<string> $autorizedFields
	 *     List des champs autorisée
	 *		
	 * @return Array
	 *     - val : resultat des recherches
	 *     - valide : false si au moins un paramtres est en erreur
	 *     - erreurs : listes des erreurs
	**/
	public static function contextCollection(Request $request, $autorizedFields)
	{
		$recherches = [
			"range" 	=> self::getRange($request),
			"filtres" 	=> self::getFiltres($request, $autorizedFields),
			"sort" 		=> self::getSort($request, $autorizedFields),
			"desc" 		=> self::getDesc($request, $autorizedFields),
			"fields" 	=> self::getFields($request, $autorizedFields),
		];


		$erreurs = [];
		$valide = true;
		foreach ($recherches as $recherche)
		{
			if(!$recherche["valide"])
			{
				$valide = false;
			}

			$erreurs += $recherche["erreurs"];
		}


		return [
			"valide" => $valide,
			"erreurs" => $erreurs,
			"elements" => $recherches
		];
	}



	/**
	 * Recherche dans un objet <request>, les parametres 'range, filtre, desc, sort, fields'.
	 *
	 * @param Request $request
	 *     Ojet Request à analyser
	 * @param Array<string> $autorizedFields
	 *     List des champs autorisée
	 *		
	 * @return Array
	 *     - val : resultat des recherches
	 *     - valide : false si au moins un paramtres est en erreur
	 *     - erreurs : listes des erreurs
	**/
	public static function contextSingle(Request $request, $autorizedFields)
	{
		$recherches = [
			"fields" 	=> self::getFields($request, $autorizedFields)
		];

		$erreurs = [];
		$valide = true;
		foreach ($recherches as $recherche)
		{
			if(!$recherche["valide"])
			{
				$valide = false;
			}

			$erreurs += $recherche["erreurs"];
		}

		return [
			"valide" => $valide,
			"erreurs" => $erreurs,
			"elements" => $recherches
		];
	}


	/**
	 * Recherche dans un objet <request>, le parametre 'range'.
	 *
	 * @param Request $request
	 *     Ojet Request à analyser
	 *		
	 * @return ["val" => Array<string>, "valide" => booléan, "erreurs" => [string]]
	 *     - val[,] : index du premiers et derniers item à retourner,
	 *     - valide : passe a false si un champs tester n'est pas dans la liste des champs autorisés
	 *     - erreurs : listes des erreurs
	**/
	public static function getRange(Request $request)
	{
		$reponse = [
			"val" => [],
			"valide" => true,
			"erreurs" => []
		];


		$input = $request->input("range", false);
		if(!$input)
		{
			return $reponse;
		}


		$elements = [];
		if(!preg_match("/^([0-9]+)-([0-9]+)$/", $input, $elements))
		{
			$reponse["valide"] = false;
			$reponse["erreurs"] = ["L'argument fournis pour le range est invalide"];
			return $reponse;
		}


		$reponse["val"] = [$elements[1], $elements[2]];
		return $reponse;
	}



	/**
	 * Recherche dans un objet <request>, le parametre 'filtre'.
	 *
	 * @param Request $request
	 *     Ojet Request à analyser
	 * @param Array<string> $autorizedFields
	 *     List des champs autorisée
	 *		
	 * @return ["val" => Array<string>, "valide" => booléan, "erreurs" => [string]]
	 *     - val : listes des champs à trier de façon descendante,
	 *     - valide : passe a false si un champs tester n'est pas dans la liste des champs autorisés
	 *     - erreurs : listes des erreurs
	**/
	public static function getFiltres(Request $request, Array $autorizedFields)
	{
		$reponse = [
			"val" => [],
			"valide" => true,
			"erreurs" => []
		];


		foreach ($autorizedFields as $candidat) 
		{
			$input = $request->input($candidat, false);
			if($input)
			{
				$reponse["val"][$candidat] = $input;
			}
		}


		return $reponse;
	}



	/**
	 * Recherche dans un objet <request>, le parametre 'desc'.
	 *
	 * @param Request $request
	 *     Ojet Request à analyser
	 * @param Array<string> $autorizedFields
	 *     List des champs autorisée
	 *		
	 * @return ["val" => Array<string>, "valide" => booléan, "erreurs" => [string]]
	 *     - val : listes des champs à trier de façon descendante,
	 *     - valide : passe a false si un champs tester n'est pas dans la liste des champs autorisés
	 *     - erreurs : listes des erreurs
	**/
	public static function getDesc(Request $request, Array $autorizedFields)
	{
		return self::matchAutorizedFields(
			$request,
			"desc",
			$autorizedFields
		);
	}



	/**
	 * Recherche dans un objet <request>, le parametre 'sort'.
	 *
	 * @param Request $request
	 *     Ojet Request à analyser
	 * @param Array<string> $autorizedFields
	 *     List des champs autorisée
	 *		
	 * @return ["val" => Array<string>, "valide" => booléan, "erreurs" => [string]]
	 *     - val : listes des champs à trier,
	 *     - valide : passe a false si un champs tester n'est pas dans la liste des champs autorisés
	 *     - erreurs : listes des erreurs
	**/
	public static function getSort(Request $request, Array $autorizedFields)
	{
		return self::matchAutorizedFields(
			$request,
			"sort",
			$autorizedFields
		);
	}



	/**
	 * Recherche dans un objet <request>, le parametre 'fields'.
	 *
	 * @param Request $request
	 *     Ojet Request à analyser
	 * @param Array<string> $autorizedFields
	 *     List des champs autorisée
	 *		
	 * @return ["val" => Array<string>, "valide" => booléan, "erreurs" => [string]]
	 *     - val : listes des champs à afficher,
	 *     - valide : passe a false si un champs tester n'est pas dans la liste des champs autorisés
	 *     - erreurs : listes des erreurs
	**/
	public static function getFields(Request $request, Array $autorizedFields)
	{
		return self::matchAutorizedFields(
			$request,
			"fields",
			$autorizedFields
		);
	}



	/**
	 * Recherche dans un objet <request>, pour un attribut <cible>, une liste de champs.
	 * Compare cette liste par rapport à une liste défini.
	 *
	 * @param Request $request
	 *     Ojet Request à analyser
	 * @param string $cible
	 *     Nom du parametre à analyser
	 * @param Array<string> $autorizedFields
	 *     List des champs autorisée
	 *		
	 * @return ["val" => Array<string>, "valide" => booléan, "erreurs" => [string]]
	 *     - val : listes des champs trouvé,
	 *     - valide : passe a false si un champs tester n'est pas dans la liste des champs autorisés
	 *     - erreurs : listes des erreurs
	**/
	public static function matchAutorizedFields(Request $request, string $cible, Array $autorizedFields)
	{
		$reponse = [
			"val" => [],
			"valide" => true,
			"erreurs" => []
		];


		$input = $request->input($cible, false);
		if(!$input)
		{
			return $reponse;
		}


		$fields = explode(",", $input);	
		$unauthorizedFields = array_diff($fields, $autorizedFields);
		if(!empty($unauthorizedFields))
		{
			$reponse["valide"] = false;
			$reponse["erreurs"] = ["Le champs suivant n'est pas autorisé :".implode(",", $unauthorizedFields)];
			return $reponse;
		}


		$reponse["val"] = $fields;
		return $reponse;
	}
}