#pragma once

#include <Windows.h>
#include <cstdint>
#include <d3d11.h>

#include "Offsets.hpp"

#include "SDK/AIBaseCommon.hpp"
#include "SDK/AIHero.hpp"
#include "SDK/AITurret.hpp"
#include "SDK/AIMinionClient.hpp"
#include "SDK/ChampionManager.hpp"
#include "SDK/GameClient.hpp"
#include "SDK/ManagerTemplate.hpp"

class offset_signature {
public:
	std::vector<std::string> pattern;
	bool sub_base;
	bool read;
	bool relative;
	std::int32_t additional;
	std::uint64_t* offset;
};

class Memory {
public:
	void Search(bool gameClient = true);

	std::uintptr_t base;
	HWND window;

	GameClient* client;
	AIBaseCommon* localPlayer;
	ManagerTemplate<AIHero>* heroList;
	ManagerTemplate<AIMinionClient>* minionList;
	ManagerTemplate<AITurret>* turretList;
	ChampionManager* championManager;
	
	std::uintptr_t materialRegistry;
	IDXGISwapChain* swapChain;

	using translateString_t = const char* (__fastcall*)(const char*);

	translateString_t translateString;
private:
	void update(bool gameClient = true) noexcept;

	std::vector<offset_signature> gameClientSig
	{
		{
			{
				"83 F8 01 75 ? 48 8B 05 ? ? ? ? 8B 48 10"
			}, true, false, true, 5, &offsets::global::GameClient
		}
	};

	std::vector<offset_signature> sigs
	{
		{
			{
				"80 3A 00 4C 8B C2 74 11 0F 1F 84 00 00 00 00 00 49 FF C0 41 80 38 00 75 F7 E9"
			}, true, false, false, 0, &offsets::functions::AString__Assign
		},
		{
			{
				"48 8B 3D ? ? ? ? 48 85 FF 74 15 48 81 C7"
			}, true, false, true, 0, &offsets::global::Player
		},
		{
			{
				"48 8B 05 ? ? ? ? 48 8B 78 08 8B 40 10 48 8D 2C C7 48 3B FD 74 ? 48 8B 37 49 3B F5"
			}, true, false, true, 0, &offsets::global::ManagerTemplate_AIHero_
		},
		{
			{
				"48 8B 0D ? ? ? ? 48 69 D0 ? ? 00 00 48 8B 05"
			}, true, false, true, 0, &offsets::global::ChampionManager
		},
		{
			{
				"48 8B 0D ? ? ? ? E8 ? ? ? ? 48 8B 0D ? ? ? ? E8 ? ? ? ? 48 8B 0D ? ? ? ? E8 ? ? ? ? 48 8B 0D ? ? ? ? 48 8B 01"
			}, true, false, true, 0, &offsets::global::ManagerTemplate_AIMinionClient_
		},
		{
			{
				"48 8B 05 ? ? ? ? 48 8B 58 28 48 85 DB 74 ? 83 43 1C 02"
			}, true, false, true, 0, &offsets::global::ManagerTemplate_AITurret_
		},
		{
			{
				"48 8B 0D ? ? ? ? FF 15 ? ? ? ? 48 8B 05 ? ? ? ?"
			}, true, false, true, 0, &offsets::global::Riot__g_window
		},
		{
			{
				"48 8D 8D ? ? 00 00 44 8B 8C 24 ? ? 00 00"
			}, false, true, false, 0, &offsets::AIBaseCommon::CharacterDataStack
		},
		{
			{
				"48 8D 8F ? ? ? ? C7 45 ? 00 00 80 3F 8D 86 ? ? ? ?"
			}, false, false, false, 0, &offsets::AIBaseCommon::SkinId
		},
		{
			{
				"48 8D BB ? ? ? ? C6 83 ? ? ? ? ? 0F 84"
			}, false, true, false, 0, &offsets::MaterialRegistry::SwapChain
		},
		{
			{
				"88 44 24 28 0F B6 84 24 00 01 00 00 88 44 24 20 E8 ? ? ? ?"
			}, true, false, false, 16, &offsets::functions::CharacterDataStack__Push
		},
		{
			{
				"88 54 24 10 55 53 56 57 41 54 41 55 41 56 41"
			}, true, false, false, 0, &offsets::functions::CharacterDataStack__Update
		},
		{
			{
				"E8 ? ? ? ? 8B ? 34 45 33 C9"
			}, true, false, false, 0, &offsets::functions::Riot__Renderer__MaterialRegistry__GetSingletonPtr
		},
		{
			{
				"E8 ? ? ? ? 41 B8 05 00 00 00 48 8D 55 40 48 8B CE 48 8B D8 E8"
			}, true, false, false, 0, &offsets::functions::translateString_UNSAFE_DONOTUSE
		},
		{
			{
				"E8 ? ? ? ? 4C 3B ? 0F 94 C0"
			}, true, false, false, 0, &offsets::functions::GetGoldRedirectTarget
		}
	};
};
