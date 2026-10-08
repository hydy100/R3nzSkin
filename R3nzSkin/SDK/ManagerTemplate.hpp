#pragma once

#include <cstdint>

#include "Pad.hpp"

template <class T>
class ManagerTemplate {
	PAD(0x8)
	T** list;
	std::int32_t length;
	std::int32_t capacity;
};

[[nodiscard]] inline bool saneCount(const std::int32_t n) noexcept { return n > 0 && n <= 10000; }
