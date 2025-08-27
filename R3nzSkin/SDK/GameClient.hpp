#pragma once

#include "GameState.hpp"
#include "Pad.hpp"

class GameClient {
	PAD(0x10)
	GGameState_s game_state;
};
